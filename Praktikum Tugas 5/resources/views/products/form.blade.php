@extends('template')

@section('title', 'Form ' . $title . ' Produk')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <h4>Form {{ $title }} Produk</h4>
        <form class="border p-4" method="POST" action="{{ $route }}">
            @csrf
            @if($method === 'PUT')
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
