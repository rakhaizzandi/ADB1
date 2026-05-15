@extends('template')

@section('title', 'Detail Produk')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <h4>Detail Produk</h4>
        <div class="card">
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $product->name }}</p>
                <p><strong>Harga:</strong> {{ number_format($product->price, 0, ',', '.') }}</p>
                <p><strong>Variant:</strong></p>
                <ul>
                    @foreach($product->variants as $variant)
                        <li>{{ $variant->name }} ({{ $variant->processor }}, {{ $variant->memory }}, {{ $variant->storage }})</li>
                    @endforeach
                </ul>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
