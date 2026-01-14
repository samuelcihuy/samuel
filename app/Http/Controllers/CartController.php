<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

  public function add(Request $request, Product $product)
{
    $qty = max(1, (int) $request->qty);

    $cart = session()->get('cart', []);

    if (isset($cart[$product->id])) {
        $cart[$product->id]['qty'] += $qty;
    } else {
        $cart[$product->id] = [
            'product_id' => $product->id,
            'name'       => $product->name,
            'price'      => $product->price,
            'qty'        => $qty,
        ];
    }
        

        session()->put('cart', $cart);

        return redirect('/cart')->with('success', 'Produk masuk keranjang');
    }

   public function remove($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        unset($cart[$id]); 
        session()->put('cart', $cart);
    }

    return redirect('/cart')->with('success', 'Produk berhasil dihapus');
}

    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Keranjang dikosongkan');
    }
}
