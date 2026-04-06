<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function dashboard() {
        // Jika admin mencoba buka dashboard pelanggan, kembalikan ke habitatnya
        if(auth()->user()->role === 'super_admin') {
            return redirect()->route('admin.orders');
        }

        $orders = Order::where('user_id', auth()->id())->latest()->get();
        return view('customer.dashboard', compact('orders'));
    }
}