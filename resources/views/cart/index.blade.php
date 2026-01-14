@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white py-8 px-4">
  <div class="max-w-7xl mx-auto">

    <!-- BACK -->
    <a href="/"
       class="inline-flex items-center gap-3 mb-8 text-indigo-600 hover:text-indigo-800 font-medium group transition-all duration-300">
      <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
      </svg>
      <span class="group-hover:underline">Kembali Belanja</span>
    </a>

    <!-- Header -->
    <div class="mb-8">
      <h2 class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
        Keranjang Belanja
      </h2>
      <p class="text-gray-600 mt-2">Review dan lengkapi pesanan Anda</p>
    </div>

    @if(count($cart) == 0)
      <!-- Empty State -->
      <div class="max-w-md mx-auto bg-white rounded-2xl shadow-lg p-12 text-center border border-gray-100">
        <div class="w-24 h-24 mx-auto bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-6">
          <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
          </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-700 mb-3">Keranjang Masih Kosong</h3>
        <p class="text-gray-500 mb-6">Mulai tambahkan produk favorit Anda</p>
        <a href="/" class="inline-block px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
          Mulai Belanja
        </a>
      </div>
    @else
      <!-- Cart Table -->
      <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 mb-8">
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
              <tr>
                <th class="p-6 text-left font-semibold text-gray-700 text-lg">Produk</th>
                <th class="p-6 text-center font-semibold text-gray-700 text-lg">Qty</th>
                <th class="p-6 text-right font-semibold text-gray-700 text-lg">Harga</th>
                <th class="p-6 text-right font-semibold text-gray-700 text-lg">Subtotal</th>
                <th class="p-6 text-right font-semibold text-gray-700 text-lg"></th>
              </tr>
            </thead>
            <tbody>
              @php $total = 0; @endphp
              @foreach($cart as $item)
                @php
                  $subtotal = $item['price'] * $item['qty'];
                  $total += $subtotal;
                @endphp
                <tr class="border-t border-gray-100 hover:bg-gray-50/50 transition-colors duration-200">
                  <td class="p-6 font-medium text-gray-900">
                    <div class="flex items-center gap-4">
                      <div class="w-16 h-16 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=100&h=100&fit=crop" 
                             alt="{{ $item['name'] }}"
                             class="w-full h-full object-cover">
                      </div>
                      <span class="font-semibold">{{ $item['name'] }}</span>
                    </div>
                  </td>
                  <td class="p-6 text-center">
                    <div class="inline-flex items-center gap-3">
                      <span class="font-bold text-lg min-w-[40px]">{{ $item['qty'] }}</span>
                    </div>
                  </td>
                  <td class="p-6 text-right text-lg font-semibold text-gray-900">
                    Rp{{ number_format($item['price']) }}
                  </td>
                  <td class="p-6 text-right">
                    <span class="text-xl font-bold text-indigo-700">
                      Rp{{ number_format($subtotal) }}
                    </span>
                  </td>
                  <td class="p-6 text-right">
                    <form action="/cart/remove/{{ $item['product_id'] }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus produk ini dari keranjang?')">
                      @csrf
                      <button type="submit" 
                              class="w-12 h-12 flex items-center justify-center rounded-xl bg-red-50 hover:bg-red-100 text-red-500 hover:text-red-600 transition-all duration-300 transform hover:scale-105 active:scale-95">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <div class="mt-6 flex flex-col md:flex-row justify-between gap-6">
        <div class="bg-white rounded-2xl shadow-lg p-6 w-full md:w-1/2 border border-gray-100">
          <div class="flex justify-between items-center mb-6">
            <p class="text-2xl font-bold text-gray-900">Total Belanja</p>
            <p class="text-4xl font-extrabold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
              Rp{{ number_format($total) }}
            </p>
          </div>
          
          <div class="space-y-3">
            <div class="flex justify-between text-gray-600">
              <span>Subtotal Produk</span>
              <span>Rp{{ number_format($total) }}</span>
            </div>
            <div class="flex justify-between text-gray-600">
              <span>Pengiriman</span>
              <span class="text-green-600 font-semibold">Gratis</span>
            </div>
            <div class="border-t border-gray-200 pt-3">
              <div class="flex justify-between text-lg font-semibold">
                <span>Total Pembayaran</span>
                <span class="text-indigo-700">Rp{{ number_format($total) }}</span>
              </div>
            </div>
          </div>
        </div>

        <form method="POST" action="/checkout"
              class="bg-white rounded-2xl shadow-xl p-6 w-full md:w-1/2 border border-gray-100">
          @csrf
          <h3 class="font-semibold text-2xl text-gray-900 mb-6 pb-4 border-b border-gray-100">
            Data Pembeli
          </h3>

          <div class="space-y-6">
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
              <input name="name" placeholder="Masukkan nama lengkap"
                  class="w-full border-2 border-gray-200 p-4 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200"
                  required>
            </div>

            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
              <input name="email" type="email" placeholder="email@contoh.com"
                  class="w-full border-2 border-gray-200 p-4 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200"
                  required>
            </div>

            <div class="pt-4">
              <button type="submit"
                  class="w-full py-4 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 
                         text-white font-bold text-lg rounded-xl shadow-lg hover:shadow-xl 
                         transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0
                         flex items-center justify-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
                Checkout & Download Invoice
              </button>
              
              <p class="text-center text-gray-500 text-sm mt-4">
                Dengan melanjutkan, Anda menyetujui Syarat & Ketentuan kami
              </p>
            </div>
          </div>
        </form>
      </div>
    @endif
  </div>
</div>
@endsection