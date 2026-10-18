<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Insert clearly labelled demo catalog records without overwriting
     * existing products or creating duplicates when this seeder runs again.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Frame Classic Bulat Hitam',
                'category' => 'frame',
                'description' => '[DATA DEMO] Bingkai bergaya klasik dengan bentuk bulat dan warna hitam. Harga serta stok hanya contoh untuk demonstrasi; bukan harga atau persediaan aktual.',
                'price' => 125000,
                'stock' => 12,
                'image' => 'https://images.unsplash.com/photo-1574258495973-f010dfbb5371?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Frame Minimalis Transparan',
                'category' => 'frame',
                'description' => '[DATA DEMO] Bingkai minimalis transparan untuk tampilan modern sehari-hari. Harga serta stok hanya contoh untuk demonstrasi; bukan harga atau persediaan aktual.',
                'price' => 165000,
                'stock' => 8,
                'image' => 'https://images.unsplash.com/photo-1577803645773-f96470509666?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Frame Kotak Premium',
                'category' => 'frame',
                'description' => '[DATA DEMO] Bingkai bentuk kotak dengan desain profesional. Harga serta stok hanya contoh untuk demonstrasi; bukan harga atau persediaan aktual.',
                'price' => 195000,
                'stock' => 6,
                'image' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Frame Ringan Harian',
                'category' => 'frame',
                'description' => '[DATA DEMO] Bingkai ringan untuk inspirasi pemakaian harian. Harga serta stok hanya contoh untuk demonstrasi; bukan harga atau persediaan aktual.',
                'price' => 99000,
                'stock' => 15,
                'image' => 'https://images.unsplash.com/photo-1508296695146-257a814070b4?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Lensa Single Vision Basic',
                'category' => 'lensa',
                'description' => '[DATA DEMO] Contoh lensa single vision. Resep, indeks, coating, dan kecocokan harus dikonfirmasi dengan optik sebelum pembelian. Harga serta stok hanya contoh.',
                'price' => 150000,
                'stock' => 10,
                'image' => 'https://images.unsplash.com/photo-1574258495973-f010dfbb5371?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Lensa Anti Radiasi Demo',
                'category' => 'lensa',
                'description' => '[DATA DEMO] Contoh listing lensa dengan opsi coating. Spesifikasi dan klaim perlindungan belum diverifikasi; konfirmasi dengan optik. Harga serta stok hanya contoh.',
                'price' => 225000,
                'stock' => 7,
                'image' => 'https://images.unsplash.com/photo-1577803645773-f96470509666?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Lensa Photochromic Demo',
                'category' => 'lensa',
                'description' => '[DATA DEMO] Contoh listing lensa photochromic. Pilihan indeks, resep, dan performa perlu dikonfirmasi; harga serta stok hanya contoh.',
                'price' => 350000,
                'stock' => 5,
                'image' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Lensa Progresif Demo',
                'category' => 'lensa',
                'description' => '[DATA DEMO] Contoh listing lensa progresif. Memerlukan resep dan pengukuran profesional; harga serta stok hanya contoh dan bukan penawaran aktual.',
                'price' => 650000,
                'stock' => 3,
                'image' => 'https://images.unsplash.com/photo-1508296695146-257a814070b4?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Sunglasses Aviator Classic',
                'category' => 'sunglasses',
                'description' => '[DATA DEMO] Kacamata hitam bergaya aviator untuk inspirasi gaya. Perlindungan UV tidak diklaim tanpa spesifikasi terverifikasi. Harga serta stok hanya contoh.',
                'price' => 175000,
                'stock' => 9,
                'image' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Sunglasses Cat Eye',
                'category' => 'sunglasses',
                'description' => '[DATA DEMO] Kacamata hitam dengan siluet cat-eye. Spesifikasi lensa dan perlindungan UV perlu diverifikasi; harga serta stok hanya contoh.',
                'price' => 185000,
                'stock' => 6,
                'image' => 'https://images.unsplash.com/photo-1508296695146-257a814070b4?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Sunglasses Sport',
                'category' => 'sunglasses',
                'description' => '[DATA DEMO] Contoh kacamata hitam bergaya sporty. Bukan rekomendasi keselamatan untuk olahraga tanpa spesifikasi terverifikasi. Harga serta stok hanya contoh.',
                'price' => 210000,
                'stock' => 5,
                'image' => 'https://images.unsplash.com/photo-1577803645773-f96470509666?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Sunglasses Oversized',
                'category' => 'sunglasses',
                'description' => '[DATA DEMO] Kacamata hitam berbingkai oversized. Spesifikasi produk dan perlindungan UV belum diverifikasi; harga serta stok hanya contoh.',
                'price' => 199000,
                'stock' => 4,
                'image' => 'https://images.unsplash.com/photo-1574258495973-f010dfbb5371?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Lensa Kontak Harian Demo',
                'category' => 'contact',
                'description' => '[DATA DEMO] Contoh listing lensa kontak harian. Pemilihan, ukuran, dan pemakaian harus mengikuti saran profesional; harga serta stok hanya contoh.',
                'price' => 85000,
                'stock' => 10,
                'image' => 'https://images.unsplash.com/photo-1577803645773-f96470509666?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Lensa Kontak Bulanan Demo',
                'category' => 'contact',
                'description' => '[DATA DEMO] Contoh listing lensa kontak bulanan. Parameter dan jadwal penggantian harus sesuai saran profesional; harga serta stok hanya contoh.',
                'price' => 120000,
                'stock' => 8,
                'image' => 'https://images.unsplash.com/photo-1574258495973-f010dfbb5371?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Lensa Kontak Warna Demo',
                'category' => 'contact',
                'description' => '[DATA DEMO] Contoh listing lensa kontak berwarna. Pastikan produk legal, sesuai mata, dan direkomendasikan profesional; harga serta stok hanya contoh.',
                'price' => 110000,
                'stock' => 6,
                'image' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Cairan Perawatan Kontak Demo',
                'category' => 'contact',
                'description' => '[DATA DEMO] Contoh listing cairan perawatan lensa kontak. Merek, isi, kompatibilitas, dan tanggal kedaluwarsa harus diperiksa; harga serta stok hanya contoh.',
                'price' => 45000,
                'stock' => 12,
                'image' => 'https://images.unsplash.com/photo-1508296695146-257a814070b4?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Kotak Kacamata Hardcase',
                'category' => 'accessories',
                'description' => '[DATA DEMO] Kotak keras untuk contoh aksesori penyimpanan kacamata. Harga serta stok hanya contoh untuk demonstrasi.',
                'price' => 35000,
                'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1574258495973-f010dfbb5371?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Kain Microfiber Demo',
                'category' => 'accessories',
                'description' => '[DATA DEMO] Contoh kain microfiber untuk membersihkan lensa. Harga serta stok hanya contoh untuk demonstrasi.',
                'price' => 12000,
                'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1577803645773-f96470509666?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Tali Kacamata Adjustable',
                'category' => 'accessories',
                'description' => '[DATA DEMO] Contoh tali kacamata yang dapat disesuaikan. Harga serta stok hanya contoh untuk demonstrasi.',
                'price' => 18000,
                'stock' => 18,
                'image' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Obeng Mini Kacamata Demo',
                'category' => 'accessories',
                'description' => '[DATA DEMO] Contoh kit obeng mini untuk aksesori kacamata. Harga serta stok hanya contoh untuk demonstrasi.',
                'price' => 22000,
                'stock' => 14,
                'image' => 'https://images.unsplash.com/photo-1508296695146-257a814070b4?auto=format&fit=crop&w=900&q=80',
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                [
                    'name' => $product['name'],
                    'category' => $product['category'],
                ],
                $product
            );
        }
    }
}
