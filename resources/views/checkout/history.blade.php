@extends('layouts.app')

      @section('content')
        <div class="min-h-screen bg-gradient-to-b from-gray-50 to-white py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow p-6">
            <div class="flex items-center justify-between mb-6">
                             
            <h2 class="text-2xl font-bold">Riwayat Pembelian</h2>
            <div class="flex items-center gap-3">
            <a href="/" class="text-sm text-gray-500">Kembali belanja</a>                        
            <form action="/history/delete-all" method="POST" onsubmit="return confirm('Hapus SEMUA riwayat checkout?');">
            @csrf
            <button type="submit" class="text-sm px-3 py-1 bg-red-50 text-red-600 rounded-md hover:bg-red-100">Hapus Semua</button>
            </form>
          </div>
            </div>

                @if($orders->isEmpty())
                    <div class="text-center py-8 text-gray-500">Belum ada transaksi.</div>

                @else
                    @if(session('success'))
                        <div class="mb-4 p-3 text-sm bg-green-50 text-green-700 rounded">{{ session('success') }}</div>
                    @endif
                    
                    @if(session('error'))
                        <div class="mb-4 p-3 text-sm bg-red-50 text-red-700 rounded">{{ session('error') }}</div>
                    @endif
                    <div class="space-y-4 md:space-y-0 md:grid md:grid-cols-2 md:gap-4">
                    @foreach($orders as $order)
                    <div class="border rounded-lg p-4 flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                        <div>
                        <div class="font-semibold">Order #{{ $order->id }} — <span class="text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</span></div>
                        <div class="text-sm text-gray-600">{{ $order->customer_name }} &middot; {{ $order->customer_email }}</div>
                        <div class="text-sm text-gray-700 mt-2">Items:</div>
                        <ul class="text-sm text-gray-600 mt-1 ml-4 list-disc">
                            @foreach($order->items as $it)
                            <li>{{ $it->qty }} × Produk ID {{ $it->product_id }} — Rp{{ number_format($it->price) }}</li>
                            @endforeach
                        </ul>
                        </div>

                        <div class="flex items-center gap-3">
                        <div class="text-right">
                            <div class="text-sm text-gray-500">Total</div>
                            <div class="font-bold">Rp{{ number_format($order->total) }}</div>
                        </div>

                                                <div class="flex flex-col md:flex-row md:items-center gap-3">
                                                    <a href="/checkout/{{ $order->id }}" class="px-3 py-2 bg-indigo-50 text-indigo-600 rounded-md text-sm hover:bg-indigo-100">Detail</a>
                                                    <form action="/history/delete/{{ $order->id }}" method="POST" onsubmit="return confirm('Hapus order #{{ $order->id }}?');">
                                                            @csrf
                                                            <button type="submit" class="ml-0 md:ml-2 px-3 py-2 bg-red-50 text-red-600 rounded-md text-sm hover:bg-red-100">Hapus</button>
                                                    </form>
                                                </div>
                        </div>
                    </div>
                    @endforeach
                    </div>
                @endif
                </div>
            </div>
            </div>
            @endsection
