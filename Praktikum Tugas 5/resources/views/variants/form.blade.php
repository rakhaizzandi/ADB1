@extends('template')

@section('title', 'Form ' . $title . ' Variant')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <h4>Form {{ $title }} Variant</h4>
        <form class="border p-4" method="POST" action="{{ $route }}">
            @csrf
            @if($method === 'PUT')
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="product_id" class="form-label">Produk</label>
                <select name="product_id" id="product_id" class="form-select @error('product_id') is-invalid @enderror">
                    <option value="">Pilih produk</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id', $variant->product_id) == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
                @error('product_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nama Variant</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $variant->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $variant->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="processor" class="form-label">Processor</label>
                <input type="text" name="processor" id="processor" class="form-control @error('processor') is-invalid @enderror" value="{{ old('processor', $variant->processor) }}">
                @error('processor')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="memory" class="form-label">Memory</label>
                <input type="text" name="memory" id="memory" class="form-control @error('memory') is-invalid @enderror" value="{{ old('memory', $variant->memory) }}">
                @error('memory')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="storage" class="form-label">Storage</label>
                <input type="text" name="storage" id="storage" class="form-control @error('storage') is-invalid @enderror" value="{{ old('storage', $variant->storage) }}">
                @error('storage')
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
