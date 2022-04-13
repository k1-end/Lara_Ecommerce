<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Image;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Product::factory(50)->state(new Sequence(
        //     ['brand'=>'Sam'],
        //     ['brand'=>'LG'],
        //     ['brand'=>'Life'],
        //     ['brand'=>'Leno'],
        //     ['brand'=>'TCO'],
        //     ))
        //     ->state(new Sequence(
        //     ['category'=>'Phone'],
        //     ['category'=>'Laptop'],
        //     ['category'=>'PC'],
        //     ['category'=>'Accessory'],
        //     ['category'=>'Software'],
        //     ))
        //     ->create(); 
        $products = json_decode(file_get_contents('/home/keyvan/Pictures/Test Date/p.json'));
        foreach ($products as $p ) {
            if (filesize($p->thumbnail) > 1024 * 1024 ) {
                continue;
            }
            $product = new \App\Models\Product();
            $product->name = $p->name;
            $product->desc = $p->desc;
            $product->brand = $p->brand;
            $product->price = $p->price;
            $product->category = $p->category;
            //$product->thumbnail = $p->thumbnail;
            $img = Image::make($p->thumbnail);
            if ($img->width() > 1000) {
                $img->widen(1000);
                $img->save();
            }
            //echo $img->filesize() . PHP_EOL;

            // echo $p->thumbnail . PHP_EOL;

           
            $path = Storage::putFile('public/photos', new File($p->thumbnail) );
            $product->thumbnail = $path;
            $product->save();
        }
    }
}
