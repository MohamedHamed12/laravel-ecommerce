<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
class ProductSeeder extends Seeder
{
    public function run()
    {

         Product::factory(10)->create(); 

    }
}
