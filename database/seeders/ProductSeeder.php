<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $product = new Products();
        $product->name = "Product 2";
        $product->content = 10001;
        $product->SKU = 10001;
        $product->save();
    }
}
