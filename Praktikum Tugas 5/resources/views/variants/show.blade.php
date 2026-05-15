@extends('template')

@section('title', 'Detail Variant')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <h4>Detail Variant</h4>
        <div class="card">
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $variant->name }}</p>
                <p><strong>Produk:</strong> {{ $variant->product->name }}</p>
                <p><strong>Processor:</strong> {{ $variant->processor }}</p>
                <p><strong>Memory:</strong> {{ $variant->memory }}</p>
                <p><strong>Storage:</strong> {{ $variant->storage }}</p>
                <p><strong>Deskripsi:</strong></p>
                <p>{{ $variant->description }}</p>
                <a href="{{ route('variants.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
