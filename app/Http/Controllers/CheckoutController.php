<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
class CheckoutController extends Controller
{
   public function checkout(Request $request)
{
    $cart = session('cart', []);

    if (count($cart) == 0) {
        return redirect('/cart');
    }

    $total = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);

    $order = Order::create([
        'customer_name' => $request->name,
        'customer_email' => $request->email,
        'total' => $total
    ]);

    foreach ($cart as $id => $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $id,
            'qty' => $item['qty'],
            'price' => $item['price']
        ]);
    }
      $order->load('items');
        $pdf = Pdf::loadView('invoice.pdf', compact('order')) ->setPaper('A4', 'portrait');
           session()->forget('cart');

    return $pdf->download('invoice-' . $order->id . '.pdf');
}

}
