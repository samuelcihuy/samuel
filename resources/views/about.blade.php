@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <section class="bg-gradient-to-br from-pink-50 to-white dark:from-gray-900 dark:to-gray-800 rounded-lg p-8 md:p-12 flex flex-col md:flex-row items-center gap-8">
        <div class="flex-1">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white mb-4">Tentang Toko Jawir</h1>
            <p class="text-gray-700 dark:text-gray-300 mb-4">Toko Jawir hadir untuk menyediakan kebutuhan sehari-hari Anda dengan mudah dan cepat. Kami memilih produk berkualitas dan mendukung penjual lokal.</p>

            <ul class="list-disc pl-5 text-gray-600 dark:text-gray-400 space-y-2 mb-6">
                <li>Produk kurasi berkualitas.</li>
                <li>Pengiriman cepat dan terjangkau.</li>
                <li>Pelayanan pelanggan yang ramah dan responsif.</li>
            </ul>

            <div class="flex items-center gap-3">
                <a href="/" class="inline-flex items-center px-5 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded shadow">Mulai Belanja</a>
                <a href="mailto:info@tokojawir.local" class="text-sm text-gray-700 dark:text-gray-300 underline">Hubungi Kami</a>
            </div>
        </div>

        <div class="w-full md:w-1/3">
            <div class="bg-white dark:bg-gray-900 rounded-lg p-4 shadow">
                <img src="https://via.placeholder.com/600x400?text=Toko+Jawir" alt="Toko Jawir" class="w-full h-auto rounded object-cover">
            </div>
        </div>
    </section>

    <section class="mt-10">
        <h2 class="text-2xl font-semibold mb-4">Tim Kami</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach([1,2,3] as $i)
            <div class="flex items-center gap-4 bg-white dark:bg-gray-900 rounded-lg p-4 shadow">
                <div class="w-16 h-16 rounded-full bg-gray-200 dark:bg-gray-800 flex items-center justify-center text-xl font-semibold text-gray-600">T</div>
                <div>
                    <div class="font-medium text-gray-900 dark:text-white">Nama Anggota {{ $i }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Peran Tim</div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <section class="mt-10 bg-white dark:bg-gray-900 rounded-lg p-6 text-center shadow">
        <h3 class="text-xl font-medium">Ingin bekerja sama?</h3>
        <p class="text-gray-600 dark:text-gray-400 mt-2 mb-4">Kirimkan proposal atau pertanyaan anda melalui email, kami akan merespons secepatnya.</p>
        <a href="mailto:info@tokojawir.local" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Kirim Email</a>
    </section>
</div>

@endsection
