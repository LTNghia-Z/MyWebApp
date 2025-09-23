<?php

namespace Database\Seeders;
use App\Models\Product;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Laptop Gaming',
            'description' => 'Laptop cấu hình mạnh, card rời',
            'price' => 25000000,
            'stock' => 5,
        ]);

        Product::create([
            'name' => 'Điện thoại 5G',
            'description' => 'Smartphone hỗ trợ 5G tốc độ cao',
            'price' => 12000000,
            'stock' => 10,
        ]);

        Product::create([
            'name' => 'Tai nghe Bluetooth',
            'description' => 'Tai nghe không dây pin 24h',
            'price' => 1500000,
            'stock' => 30,
        ]);
    }
}
