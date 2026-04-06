<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InventoryController extends Controller
{
    // 1. Tampilkan Daftar Produk & Form Tambah
    public function index() {
        $products = Product::latest()->get();
        return view('admin.inventory.index', compact('products'));
    }

    // 2. Simpan Produk Baru (Termasuk Gambar)
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi Gambar
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    // 3. Tampilkan Halaman Edit
    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('admin.inventory.edit', compact('product'));
    }

    // 4. Proses Update Produk
    public function update(Request $request, $id) {
        $product = Product::findOrFail($id);
        
        $data = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Jika Admin upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari folder
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('admin.inventory')->with('success', 'Produk berhasil diperbarui!');
    }

    // 5. Hapus Produk
    public function destroy($id) {
        $product = Product::findOrFail($id);
        
        // Hapus gambar fisiknya agar server tidak penuh
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }
}