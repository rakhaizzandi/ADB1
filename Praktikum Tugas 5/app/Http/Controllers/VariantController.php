<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function index()
    {
        $variants = Variant::with('product')->get();

        return view('variants.index', compact('variants'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view('variants.form', [
            'title' => 'Tambah',
            'variant' => new Variant(),
            'products' => $products,
            'route' => route('variants.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:4',
            'description' => 'required|min:10',
            'processor' => 'required|min:3',
            'memory' => 'required|min:2',
            'storage' => 'required|min:2',
            'product_id' => 'required|exists:products,id',
        ]);

        Variant::create($validated);

        return redirect()->route('variants.index')->with('success', 'Variant berhasil ditambahkan');
    }

    public function show(Variant $variant)
    {
        return view('variants.show', compact('variant'));
    }

    public function edit(Variant $variant)
    {
        $products = Product::orderBy('name')->get();

        return view('variants.form', [
            'title' => 'Edit',
            'variant' => $variant,
            'products' => $products,
            'route' => route('variants.update', $variant),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, Variant $variant)
    {
        $validated = $request->validate([
            'name' => 'required|min:4',
            'description' => 'required|min:10',
            'processor' => 'required|min:3',
            'memory' => 'required|min:2',
            'storage' => 'required|min:2',
            'product_id' => 'required|exists:products,id',
        ]);

        $variant->update($validated);

        return redirect()->route('variants.index')->with('success', 'Variant berhasil diperbarui');
    }

    public function destroy(Variant $variant)
    {
        $variant->delete();

        return redirect()->route('variants.index')->with('success', 'Variant berhasil dihapus');
    }
}
