<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // Menampilkan halaman utama
   public function index(Request $request) {
        // Mulai query produk
        $query = Product::query();

        // Jika ada pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Jika filter kategori diklik
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Ambil produk terbaru
        $products = $query->latest()->get();

        // Ambil daftar kategori yang unik untuk sidebar
        $categories = Product::select('category')->distinct()->get();

        return view('shop.index', compact('products', 'categories'));
    }

    // Menambah ke keranjang (menggunakan Session)
    public function addToCart(Request $request, $id) {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Kacamata berhasil ditambahkan ke keranjang!');
    }

    // Menampilkan keranjang
    public function cart() {
        return view('shop.cart');
    }

    // Proses Checkout
  public function checkout(Request $request) {
        // 1. Validation
        $request->validate([
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_address' => 'required',
            'shipping_courier' => 'required',
            'payment_method' => 'required' 
        ]);

        $cart = session('cart');
        
        // 2. Prevent Checkout if Cart is Empty (Safety Check)
        if (!$cart) {
            return redirect()->route('home')->with('error', 'Keranjang Anda kosong.');
        }

        $total_cart = 0;

        // 3. Stock Validation & Calculation Loop
        foreach($cart as $id => $details) {
            $product = \App\Models\Product::find($id); // Find the product in DB

            // Check if product exists and if requested quantity exceeds available stock
            if (!$product || $product->stock < $details['quantity']) {
                $errorMsg = $product ? "Maaf, stok " . $product->name . " tidak mencukupi." : "Produk tidak ditemukan.";
                return redirect()->route('cart')->with('error', $errorMsg);
            }

            $total_cart += $details['price'] * $details['quantity'];
        }

        // 4. Calculate Shipping Cost
        $shipping_cost = 0;
        if($request->shipping_courier == 'JNE') $shipping_cost = 15000;
        if($request->shipping_courier == 'JNT') $shipping_cost = 18000;
        if($request->shipping_courier == 'SICEPAT') $shipping_cost = 20000;

        // 5. Create the Order
        $order = \App\Models\Order::create([
            'user_id' => auth()->id(),
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'minus_left' => $request->minus_left,
            'minus_right' => $request->minus_right,
            'shipping_courier' => $request->shipping_courier,
            'shipping_cost' => $shipping_cost,
            'payment_method' => $request->payment_method, 
            'total_price' => $total_cart + $shipping_cost,
            'status' => 'pending', 
        ]);

        // 6. DECREASE PRODUCT STOCK
        foreach($cart as $id => $details) {
            $product = \App\Models\Product::find($id);
            if ($product) {
                // Subtract the ordered quantity from the current stock
                $product->update([
                    'stock' => $product->stock - $details['quantity']
                ]);
            }
        }

        // 7. Clear the Cart
        session()->forget('cart');
        
        // 8. Redirect to Payment Instruction
        return redirect()->route('payment.instruction', $order->id);
    }
    // TAMBAHKAN FUNGSI BARU INI DI BAWAHNYA
    public function paymentInstruction($id) {
        // Ambil order, pastikan order tersebut milik user yang sedang login
        $order = Order::where('user_id', auth()->id())->findOrFail($id);
        return view('shop.payment', compact('order'));
    }

    // 1. Menampilkan Halaman Detail Produk
    public function show($id) {
        $product = \App\Models\Product::findOrFail($id);
        return view('shop.show', compact('product'));
    }

    // 2. Tambah Kuantitas (+)
    public function increaseCart($id) {
        $cart = session()->get('cart', []);
        $product = \App\Models\Product::findOrFail($id);

        if(isset($cart[$id])) {
            // Cek apakah stok di database masih cukup
            if($cart[$id]['quantity'] < $product->stock) {
                $cart[$id]['quantity']++;
                session()->put('cart', $cart);
            } else {
                return redirect()->back()->with('error', 'Maaf, stok maksimal untuk ' . $product->name . ' hanya ' . $product->stock . ' pcs.');
            }
        }
        return redirect()->back();
    }

    // 3. Kurangi Kuantitas (-)
    // Kurangi Kuantitas (-)
    public function decreaseCart($id) {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            if($cart[$id]['quantity'] > 1) {
                // Jika masih lebih dari 1, kurangi angka
                $cart[$id]['quantity']--;
                session()->put('cart', $cart);
            } else {
                // PENCEGAHAN: Jika angkanya 1 dan dikurangi, langsung HAPUS itemnya.
                unset($cart[$id]);
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
            }
        }
        return redirect()->back();
    }

    // 4. Hapus Item dari Keranjang
    public function removeCart($id) {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }
    
     // Fungsi Simpan Ulasan Produk (HANYA ADA SATU)
    public function storeReview(Request $request, $id) {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // Maksimal foto 2MB
        ]);

        $existing_review = \App\Models\Review::where('user_id', auth()->id())->where('product_id', $id)->first();
        if($existing_review) {
            return redirect()->back()->with('error', 'Anda sudah memberikan ulasan untuk produk ini.');
        }

        $data = [
            'user_id' => auth()->id(),
            'product_id' => $id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('reviews', 'public');
        }

        \App\Models\Review::create($data);

        return redirect()->back()->with('success', 'Terima kasih! Ulasan Anda berhasil dikirim.');
    }
}