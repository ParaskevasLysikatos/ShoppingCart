<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Product::create([
            'name'=>'mobile_phone',
            'image'=>'mobile-phone.jpg',
            'stock_amount'=>5,
            'price'=>150.34
        ]);

        \App\Models\Product::create([
            'name'=>'laptop',
            'image'=>'laptop.jpg',
            'stock_amount'=>2,
            'price'=>560.77
        ]);

        \App\Models\Product::create([
            'name'=>'tablet',
            'image'=>'tablet.jpg',
            'stock_amount'=>0,
            'price'=>110.22
        ]);
    }
}
