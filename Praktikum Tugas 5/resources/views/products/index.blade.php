@extends('template')

@section('title', 'Daftar Produk')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-10">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Daftar Produk</h4>
            <div>
                <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Produk</a>
                <a href="{{ route('variants.index') }}" class="btn btn-secondary">Kelola Variant</a>
            </div>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Variant</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                            @if($product->variants->isEmpty())
                                <span class="text-muted">Tidak ada variant</span>
                            @else
                                <ul class="mb-0">
                                    @foreach($product->variants as $variant)
                                        <li>
                                            <strong>{{ $variant->name }}</strong><br>
                                            Desc: {{ $variant->description }}<br>
                                            Proc: {{ $variant->processor }}<br>
                                            RAM: {{ $variant->memory }}<br>
                                            Strg: {{ $variant->storage }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form method="POST" action="{{ route('products.destroy', $product) }}" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
