<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert(
            [
                [
                    'name' => 'Samsung 32 HD',
                    'description' => 'Wide Color Enhancer, Connect Share Transfer, HD resolution.',
                    'price' => '3025000',
                    'category_id' => '1',
                    'image_path' => 'samsung-32-hd.jpg',
                ],
                [
                    'name' => 'iPhone XR',
                    'description' => 'Meet the new Apple iPhone XR smartphone! Featuring a 6.1” Liquid Retina LCD Display, faster Face ID and the most powerful chip in a smartphone.',
                    'price' => '7500000',
                    'category_id' => '3',
                    'image_path' => 'iphone-xr.jpg',
                ],
                [
                    'name' => 'Asus TUF Gaming FX505DT',
                    'description' => 'Designed for a world of entertainment with ultra-fast responsiveness and exceptional battery life, the new 2 nd Gen AMD Ryzen.',
                    'price' => '13499000',
                    'category_id' => '2',
                    'image_path' => 'asus-tuf-gaming-fx505dt.jpg',
                ],
                [
                    'name' => 'LG 43 FHD',
                    'description' => 'From streaming to sports to gaming, the HD 1080p display offers a crisp, clear picture that brings dynamic color.',
                    'price' => '4000000',
                    'category_id' => '1',
                    'image_path' => 'lg-43-fhd.jpg',
                ],
                [
                    'name' => 'Lenovo Yoga',
                    'description' => 'Lenovo Yoga C740 2-in-1 14" FHD Touchscreen Laptop | Backlit Keyboard | Core i5-10210U | Webcam | USB-C | Amazon Alexa | Integrated Intel',
                    'price' => '20000000',
                    'category_id' => '2',
                    'image_path' => 'lenovo-yoga.jpg',
                ],
                [
                    'name' => 'Samsung s21',
                    'description' => 'Witness the fastest chip ever in a Galaxy. With a 5nm processor.',
                    'price' => '14999000',
                    'category_id' => '3',
                    'image_path' => 'samsung-s21.jpg',
                ],
                [
                    'name' => 'Acer Swift',
                    'description' => 'Disrupt the status quo with the powerful performance of Acer Swift laptops.',
                    'price' => '12594000',
                    'category_id' => '2',
                    'image_path' => 'acer-swift.jpg',
                ],
                [
                    'name' => 'Samsung 65 Crystal',
                    'description' => 'Experience your favorite movies and shows on a vibrant, stunning 4K UHD screen, using the Universal Guide to surf smoothly and select content.',
                    'price' => '16999000',
                    'category_id' => '1',
                    'image_path' => 'samsung-65-crystal.jpg',
                ],
            ]);
    }
}
