@extends('layout.main')
@section('title', 'List Produk')
@section('content')
    <!-- Navbar -->
    <div class="bg-light pb-2 px-4 flex items-center justify-between">
        <a href="{{ url('beranda') }}" class="text-dark text-3xl font-bold">←</a>
    </div>

    <!-- Daftar Produk -->
    <div class="p-4 space-y-6" id="product-list">
    </div>
@endsection

@section('script')
    <script>
    </script>
@endsection
