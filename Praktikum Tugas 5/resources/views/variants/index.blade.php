@extends('template')

@section('title', 'Daftar Variant')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-10">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Daftar Variant</h4>
            <a href="{{ route('variants.create') }}" class="btn btn-primary">Tambah Variant</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Produk</th>
                    <th>Processor</th>
                    <th>Memory</th>
                    <th>Storage</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($variants as $variant)
                    <tr>
                        <td>{{ $variant->name }}</td>
                        <td>{{ $variant->product->name }}</td>
                        <td>{{ $variant->processor }}</td>
                        <td>{{ $variant->memory }}</td>
                        <td>{{ $variant->storage }}</td>
                        <td>
                            <a href="{{ route('variants.edit', $variant) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form method="POST" action="{{ route('variants.destroy', $variant) }}" class="d-inline" onsubmit="return confirm('Yakin hapus variant?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada variant.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
