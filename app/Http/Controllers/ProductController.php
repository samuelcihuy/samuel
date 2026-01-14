<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Pakai paginate supaya pagination aktif
        $products = Product::paginate(12); // bisa ganti jumlah per halaman

        return view('products.index', compact('products'));
    }
}

