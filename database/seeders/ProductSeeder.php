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
        // echo dirname(__DIR__);
        // die;
        $test_data_dir = __DIR__ ."/.test_data/"; 
        $products = json_decode(file_get_contents($test_data_dir . 'p.json'));

        $counter = 0;
        echo "Total images found: " . count($products) . PHP_EOL;
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
            $image = Image::make($p->thumbnail);
            if ($image->height() >= 1000 && $image->width() >= 1000) {
                $image->heighten(1000);
                //$image->crop(800 , 800);
            }elseif ($image->height() < 1000 || $image->width() == 1000) {
                continue;
            }

            // echo $request->file('thumbnail')->store('public/photos') .PHP_EOL;

            $image->save($test_data_dir . '1000/img.jpg');
            $product->image = Storage::putFile('public/photos', new File($image->basePath()) );
            $image->resize(300 , 300)->save($test_data_dir . '300/img.jpg');
            $product->thumbnail = Storage::putFile('public/photos/300', new File($image->basePath()) );
            
            $product->save();
            echo $counter++ . PHP_EOL;
        }
    }
}
