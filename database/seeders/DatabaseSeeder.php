<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Create Roles & Users
        $admin = User::firstOrCreate([
            'email' => 'admin@email.com'
        ], [
            'name' => 'Super Admin',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        $provider = User::firstOrCreate([
            'email' => 'provider@email.com'
        ], [
            'name' => 'Demo Provider',
            'password' => bcrypt('password123'),
            'role' => 'provider',
            'status' => 'approved',
        ]);

        $pendingProvider = User::firstOrCreate([
            'email' => 'pending@email.com'
        ], [
            'name' => 'Pending Provider',
            'password' => bcrypt('password123'),
            'role' => 'provider',
            'status' => 'pending',
        ]);

        $customer = User::firstOrCreate([
            'email' => 'customer@email.com'
        ], [
            'name' => 'Demo Customer',
            'password' => bcrypt('password123'),
            'role' => 'customer',
            'status' => 'active',
        ]);

        // 2. Create Categories
        $clothing = \App\Models\Category::firstOrCreate(['slug' => 'clothing'], [
            'name' => 'Clothing',
            'image' => 'https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?auto=format&fit=crop&w=800&q=80'
        ]);

        $electronics = \App\Models\Category::firstOrCreate(['slug' => 'electronics'], [
            'name' => 'Electronics',
            'image' => 'https://images.unsplash.com/photo-1498049794561-7780e7231661?auto=format&fit=crop&w=800&q=80'
        ]);

        $accessories = \App\Models\Category::firstOrCreate(['slug' => 'accessories'], [
            'name' => 'Accessories',
            'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=800&q=80'
        ]);

        // 3. Create Sub-Categories
        $mens = \App\Models\Category::firstOrCreate(['slug' => 'mens-fashion'], [
            'name' => "Men's Fashion",
            'parent_id' => $clothing->id
        ]);

        $womens = \App\Models\Category::firstOrCreate(['slug' => 'womens-fashion'], [
            'name' => "Women's Fashion",
            'parent_id' => $clothing->id
        ]);

        $kids = \App\Models\Category::firstOrCreate(['slug' => 'kids-wear'], [
            'name' => 'Kids Wear',
            'parent_id' => $clothing->id
        ]);

        // 4. Create Products
        $products = [
            // Men's Fashion
            [
                'name' => "Premium Men's Suit",
                'description' => 'A sharp, tailored navy blue suit for formal occasions. Crafted from premium Italian wool with satin lining.',
                'price' => 299.99,
                'old_price' => 450.00,
                'category_id' => $mens->id,
                'image' => 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?auto=format&fit=crop&w=800&q=80',
                'stock' => 15,
                'rating' => 4.9,
                'reviews_count' => 24
            ],
            [
                'name' => 'Casual Denim Jacket',
                'description' => 'Classic denim jacket with a modern fit. Perfect for layering in any season.',
                'price' => 89.99,
                'old_price' => 120.00,
                'category_id' => $mens->id,
                'image' => 'https://images.unsplash.com/photo-1576995853123-5a10305d93c0?auto=format&fit=crop&w=800&q=80',
                'stock' => 30,
                'rating' => 4.6,
                'reviews_count' => 45
            ],
            [
                'name' => 'Slim Fit Oxford Shirt',
                'description' => 'Crisp cotton oxford shirt in a versatile white. Button-down collar for a polished look.',
                'price' => 59.99,
                'old_price' => 75.00,
                'category_id' => $mens->id,
                'image' => 'https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?auto=format&fit=crop&w=800&q=80',
                'stock' => 50,
                'rating' => 4.7,
                'reviews_count' => 67
            ],

            // Women's Fashion
            [
                'name' => 'Silky Evening Gown',
                'description' => 'Elegant silk gown with delicate embroidery. Perfect for special occasions and galas.',
                'price' => 189.99,
                'old_price' => 250.00,
                'category_id' => $womens->id,
                'image' => 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&w=800&q=80',
                'stock' => 10,
                'rating' => 4.8,
                'reviews_count' => 18
            ],
            [
                'name' => 'Cashmere Knit Sweater',
                'description' => 'Luxuriously soft cashmere sweater in a relaxed fit. Available in cream and charcoal.',
                'price' => 149.00,
                'old_price' => 200.00,
                'category_id' => $womens->id,
                'image' => 'https://images.unsplash.com/photo-1576566588028-4147f3842f27?auto=format&fit=crop&w=800&q=80',
                'stock' => 20,
                'rating' => 4.7,
                'reviews_count' => 32
            ],
            [
                'name' => 'Floral Wrap Dress',
                'description' => 'Breezy floral wrap dress perfect for spring and summer. Lightweight and flattering.',
                'price' => 79.99,
                'old_price' => null,
                'category_id' => $womens->id,
                'image' => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?auto=format&fit=crop&w=800&q=80',
                'stock' => 25,
                'rating' => 4.5,
                'reviews_count' => 41
            ],

            // Electronics
            [
                'name' => 'Smart Watch Series 7',
                'description' => 'Advanced health tracking with heart rate, SpO2, and sleep monitoring. AMOLED display with 5-day battery.',
                'price' => 399.00,
                'old_price' => 450.00,
                'category_id' => $electronics->id,
                'image' => 'https://images.unsplash.com/photo-1546868871-af0de0ae72be?auto=format&fit=crop&w=800&q=80',
                'stock' => 50,
                'rating' => 4.7,
                'reviews_count' => 120
            ],
            [
                'name' => 'Acoustic Headphones',
                'description' => 'Studio quality sound with active noise cancellation. 30-hour battery life with quick charge.',
                'price' => 149.50,
                'old_price' => 199.99,
                'category_id' => $electronics->id,
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80',
                'stock' => 30,
                'rating' => 4.6,
                'reviews_count' => 85
            ],
            [
                'name' => 'Wireless Earbuds Pro',
                'description' => 'True wireless earbuds with spatial audio and active noise cancellation. IPX5 water resistant.',
                'price' => 179.00,
                'old_price' => 229.00,
                'category_id' => $electronics->id,
                'image' => 'https://images.unsplash.com/photo-1590658268037-6bf12f032f55?auto=format&fit=crop&w=800&q=80',
                'stock' => 40,
                'rating' => 4.8,
                'reviews_count' => 156
            ],
            [
                'name' => 'Portable Bluetooth Speaker',
                'description' => 'Powerful 360-degree sound in a compact, waterproof design. 20-hour battery life.',
                'price' => 69.99,
                'old_price' => 99.99,
                'category_id' => $electronics->id,
                'image' => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?auto=format&fit=crop&w=800&q=80',
                'stock' => 60,
                'rating' => 4.4,
                'reviews_count' => 92
            ],

            // Accessories
            [
                'name' => 'Classic Leather Wallet',
                'description' => 'Genuine top-grain leather minimalist wallet. RFID blocking with space for 8 cards.',
                'price' => 45.00,
                'old_price' => 60.00,
                'category_id' => $accessories->id,
                'image' => 'https://images.unsplash.com/photo-1627123424574-724758594e93?auto=format&fit=crop&w=800&q=80',
                'stock' => 100,
                'rating' => 4.5,
                'reviews_count' => 56
            ],
            [
                'name' => 'Aviator Sunglasses',
                'description' => 'Classic aviator design with polarized lenses. UV400 protection with titanium frame.',
                'price' => 129.00,
                'old_price' => 165.00,
                'category_id' => $accessories->id,
                'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?auto=format&fit=crop&w=800&q=80',
                'stock' => 35,
                'rating' => 4.6,
                'reviews_count' => 73
            ],
            [
                'name' => 'Canvas Backpack',
                'description' => 'Premium waxed canvas backpack with laptop compartment. Water-resistant and durable.',
                'price' => 89.99,
                'old_price' => null,
                'category_id' => $accessories->id,
                'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&w=800&q=80',
                'stock' => 25,
                'rating' => 4.7,
                'reviews_count' => 38
            ],
            [
                'name' => 'Minimalist Watch',
                'description' => 'Elegant timepiece with sapphire crystal and Italian leather strap. Japanese quartz movement.',
                'price' => 199.00,
                'old_price' => 280.00,
                'category_id' => $accessories->id,
                'image' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?auto=format&fit=crop&w=800&q=80',
                'stock' => 18,
                'rating' => 4.9,
                'reviews_count' => 64
            ],

            // Kids
            [
                'name' => 'Rainbow Hoodie - Kids',
                'description' => 'Soft cotton hoodie with colorful rainbow print. Perfect for active kids.',
                'price' => 34.99,
                'old_price' => 45.00,
                'category_id' => $kids->id,
                'image' => 'https://images.unsplash.com/photo-1519238263530-99bdd11df2ea?auto=format&fit=crop&w=800&q=80',
                'stock' => 40,
                'rating' => 4.6,
                'reviews_count' => 28
            ],
        ];

        foreach ($products as $prod) {
            $prod['user_id'] = $provider->id;
            \App\Models\Product::firstOrCreate(
                ['name' => $prod['name']], // Check by name
                $prod
            );
        }
    }
}
