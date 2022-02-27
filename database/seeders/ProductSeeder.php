<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Product::factory(50)->state(new Sequence(
            ['brand'=>'Sam'],
            ['brand'=>'LG'],
            ['brand'=>'Life'],
            ['brand'=>'Leno'],
            ['brand'=>'TCO'],
            ))
            ->state(new Sequence(
            ['category'=>'Phone'],
            ['category'=>'Laptop'],
            ['category'=>'PC'],
            ['category'=>'Accessory'],
            ['category'=>'Software'],
            ))
            ->create(); 
    }
}
