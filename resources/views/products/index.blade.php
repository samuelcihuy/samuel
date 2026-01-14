@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white py-12">

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Header dengan glass effect -->
    <div class="mb-12">
      <div class="backdrop-blur-lg bg-white/80 rounded-3xl p-8 border border-white/30 shadow-xl">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
          <div>
            <h1 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
              Koleksi Produk Premium
            </h1>
            <p class="text-gray-600 mt-2">Temukan produk terbaik dengan kualitas premium</p>
          </div>
          
          <div class="flex items-center gap-4">
            <div class="relative">
            </div>
            <a href="/cart" 
               class="relative px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold rounded-2xl shadow-lg hover:shadow-xl hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 flex items-center gap-2 group overflow-hidden">
              <span class="relative z-10">🛒 Keranjang</span>
              <span class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Grid Produk -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">

      @forelse($products as $product)
      @php
          // Warna card pastel random dengan variasi lebih banyak
          $colors = [
              'bg-gradient-to-br from-blue-50 via-blue-100 to-indigo-50 border-blue-100',
              'bg-gradient-to-br from-emerald-50 via-emerald-100 to-teal-50 border-emerald-100',
              'bg-gradient-to-br from-purple-50 via-purple-100 to-pink-50 border-purple-100',
              'bg-gradient-to-br from-amber-50 via-amber-100 to-orange-50 border-amber-100',
              'bg-gradient-to-br from-rose-50 via-rose-100 to-pink-50 border-rose-100',
              'bg-gradient-to-br from-cyan-50 via-cyan-100 to-sky-50 border-cyan-100',
              'bg-gradient-to-br from-violet-50 via-violet-100 to-purple-50 border-violet-100',
              'bg-gradient-to-br from-green-50 via-green-100 to-emerald-50 border-green-100'
          ];
          $color = $colors[$loop->index % count($colors)];
      @endphp

      <div class="group flex flex-col rounded-3xl overflow-hidden border-2 {{ $color }}
                  hover:shadow-2xl hover:shadow-indigo-100/50 hover:-translate-y-3 
                  transition-all duration-500 backdrop-blur-sm">

        <!-- Image Container -->
        <div class="relative aspect-square overflow-hidden">
          @if($product->discount)
          <div class="absolute top-3 left-3 z-10">
            <span class="px-3 py-1.5 bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs font-bold rounded-full shadow-lg">
              -{{ $product->discount }}%
            </span>
          </div>
          @endif

          <!-- Quick View Overlay -->
          <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

          <img src="{{ $product->image_url ?? 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=400&fit=crop&q=80' }}"
               alt="{{ $product->name }}"
               class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        </div>

        <!-- Body -->
        <div class="p-5 flex flex-col flex-1 bg-white/70 backdrop-blur-sm">
          
          <!-- Category Badge -->
          <div class="mb-2">
            <span class="inline-block px-3 py-1 bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 text-xs font-semibold rounded-full">
              {{ $product->category ?? 'Elektronik' }}
            </span>
          </div>

          <!-- Nama Produk -->
          <h3 class="font-bold text-gray-900 text-sm line-clamp-2 mb-2 group-hover:text-indigo-700 transition-colors duration-300">
            {{ $product->name }}
          </h3>

          <!-- Deskripsi -->
          <p class="text-xs text-gray-600 line-clamp-2 mb-4 flex-1">
            {{ $product->description }}
          </p>

          <!-- Rating -->
          <div class="flex items-center gap-1 mb-3">
            <div class="flex">
              @for($i = 1; $i <= 5; $i++)
              <svg class="w-4 h-4 {{ $i <= ($product->rating ?? 4) ? 'text-amber-400' : 'text-gray-300' }}" 
                   fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
              </svg>
              @endfor
            </div>
            <span class="text-xs text-gray-500 ml-1">({{ $product->review_count ?? '128' }})</span>
          </div>

          <!-- Harga -->
          <div class="mb-4">
            @if($product->discount)
            <div class="flex flex-col gap-1">
              <div class="flex items-center gap-2">
                <span class="text-lg font-extrabold text-gray-900">
                  Rp{{ number_format($product->price * (100 - $product->discount) / 100) }}
                </span>
                <span class="text-sm text-gray-400 line-through">
                  Rp{{ number_format($product->price) }}
                </span>
              </div>
              <span class="text-xs text-green-600 font-semibold">
                Hemat Rp{{ number_format($product->price - ($product->price * (100 - $product->discount) / 100)) }}
              </span>
            </div>
            @else
            <span class="text-lg font-extrabold text-gray-900">
              Rp{{ number_format($product->price) }}
            </span>
            @endif
          </div>

          <!-- Button -->
          <form action="/cart/add/{{ $product->id }}" method="POST" class="mt-auto">
            @csrf
            <button type="submit"
              class="w-full py-3 rounded-2xl font-bold text-sm
                     bg-gradient-to-r from-indigo-500 to-purple-500 text-white
                     hover:from-indigo-600 hover:to-purple-600 hover:shadow-lg
                     shadow-md transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0
                     flex items-center justify-center gap-2 group/btn relative overflow-hidden">
              <svg class="w-5 h-5 group-hover/btn:rotate-12 transition-transform duration-300" 
                   fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
              </svg>
              <span class="relative">Tambah ke Keranjang</span>
              <span class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-purple-600 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300"></span>
            </button>
          </form>

        </div>
      </div>

      @empty
      <!-- Empty State -->
      <div class="col-span-full py-16">
        <div class="text-center max-w-md mx-auto">
          <div class="w-24 h-24 mx-auto bg-gradient-to-br from-gray-100 to-gray-200 rounded-3xl 
                     flex items-center justify-center mb-6 shadow-inner">
            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
            </svg>
          </div>
          <h3 class="text-xl font-bold text-gray-700 mb-2">Belum ada produk tersedia</h3>
          <p class="text-gray-500 mb-6">Produk akan segera hadir dalam waktu dekat</p>
          <button class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-500 
                      text-white font-semibold rounded-2xl hover:shadow-lg transition">
            Refresh Halaman
          </button>
        </div>
      </div>
      @endforelse

    </div>

    <!-- Pagination (jika ada) -->
    @if($products->hasPages())
    <div class="mt-12 flex justify-center">
      <div class="flex items-center gap-1 bg-white/80 backdrop-blur-sm rounded-2xl p-2 shadow-lg border border-gray-200/50">
        @foreach(range(1, min(5, $products->lastPage())) as $page)
        <button class="w-10 h-10 rounded-xl font-medium transition-all duration-300
                    {{ $products->currentPage() == $page 
                       ? 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white shadow-md' 
                       : 'hover:bg-gray-100 text-gray-700' }}">
          {{ $page }}
        </button>
        @endforeach
      </div>
    </div>
    @endif
  </div>
</div>
@endsection