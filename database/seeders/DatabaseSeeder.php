<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PostCategory;
use App\Models\ProductCategory;
use App\Models\Post;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin-nusantara@gmail.com',
            'password' => bcrypt('password')
        ]);

        User::create([
            'name' => 'Seller',
            'username' => 'seller',
            'email' => 'seller-nusantara@gmail.com',
            'password' => bcrypt('password')
        ]);

        User::create([
            'name' => 'User',
            'username' => 'user',
            'email' => 'user-nusantara@gmail.com',
            'password' => bcrypt('password')
        ]);

        User::factory(3)->create();

        PostCategory::create([
            'name' => 'Makanan Tradisional',
            'slug' => 'makanan-tradisional'
        ]);

        PostCategory::create([
            'name' => 'Pakaian Tradisional',
            'slug' => 'pakaian-tradisional'
        ]);

        PostCategory::create([
            'name' => 'Wisata Budaya',
            'slug' => 'wisata-budaya'
        ]);

        Post::factory(20)->create();

        ProductCategory::create([
            'name' => 'Makanan dan Minuman',
            'slug' => 'makanan-dan-minuman'
        ]);

        ProductCategory::create([
            'name' => 'Pakaian',
            'slug' => 'pakaian'
        ]);

        Product::factory(20)->create();
    }
}
