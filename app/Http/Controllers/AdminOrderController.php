<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    // Menampilkan semua pesanan pelanggan
    public function index() {
        $orders = Order::latest()->get(); 
        return view('admin.orders.index', compact('orders'));
    }

    // Mengubah status pesanan pelanggan
    public function updateStatus(Request $request, $id) {
        $request->validate([
            'status' => 'required|string',
            'tracking_number' => 'nullable|string' // Validasi untuk resi
        ]);

        $order = Order::findOrFail($id);
        
        $order->update([
            'status' => $request->status,
            'tracking_number' => $request->tracking_number // Simpan resi ke database
        ]);

        return redirect()->back()->with('success', 'Status & Resi pesanan berhasil diperbarui!');
    }
}