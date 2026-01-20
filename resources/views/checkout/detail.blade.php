@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white py-12">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl shadow p-6">
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Detail Pembelian</h2>
        <a href="/" class="text-sm text-gray-500">Kembali belanja</a>
      </div>

      @if(session('success'))
        <div class="mb-4 p-3 text-sm bg-green-50 text-green-700 rounded">{{ session('success') }}</div>
      @endif

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="p-4 bg-gray-50 rounded-lg">
          <h3 class="font-semibold mb-3">Informasi Pesanan</h3>
          <div class="text-sm text-gray-700">Order #{{ $order->id }}</div>
          <div class="text-sm text-gray-500 mb-2">{{ $order->created_at->format('d M Y H:i') }}</div>
          <div class="text-sm">Nama: <strong>{{ $order->customer_name }}</strong></div>
          <div class="text-sm">Email: <strong>{{ $order->customer_email }}</strong></div>

          <div class="mt-4">
            <h4 class="font-medium">Rincian Item</h4>
            <ul class="mt-2 space-y-2 text-sm text-gray-700">
              @foreach($order->items as $it)
                <li class="flex justify-between">
                  <div>{{ $it->qty }} × {{ $it->product->name ?? ('Produk #' . $it->product_id) }}</div>
                  <div>Rp{{ number_format($it->price * $it->qty) }}</div>
                </li>
              @endforeach
            </ul>
          </div>

        </div>

        <div class="p-6 bg-white rounded-lg border">
          <h3 class="font-semibold mb-3">Ringkasan Pembayaran</h3>
          <div class="flex items-center justify-between text-gray-600 mb-2">
            <span>Subtotal</span>
            <span>Rp{{ number_format($order->total) }}</span>
          </div>

          <div class="mt-6 flex gap-3">
            <a href="/" class="flex-1 px-4 py-3 bg-gray-100 rounded-xl text-center">Kembali Belanja</a>
            <a href="/checkout/{{ $order->id }}/invoice" target="_blank" class="flex-1 px-4 py-3 bg-indigo-600 text-white rounded-xl text-center">Cetak PDF</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
