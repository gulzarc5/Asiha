<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Size;
use App\Models\ProductImage;
use App\Models\ThirdCategory;
use App\Models\Brands;
use App\Models\Color;
use App\Models\ProductColor;
use Illuminate\Support\Str;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Truncating Tables ..................');
        // Product::truncate();
        // ProductImage::truncate();
        // ProductColor::truncate();
        // ProductSize::truncate();
        $this->command->info('Seeding Started ..................');
        $faker = Faker::create();
        for ($i=0; $i < 100; $i++) {
            $third_category = ThirdCategory::where('status',1)->inRandomOrder()->limit(1)->first();
            $brand =  Brands::where('sub_category_id',$third_category->subCategory->id)->inRandomOrder()->limit(1)->first();
            $brand_id = null;
            if ($brand) {
                $brand_id = $brand->id;
            }
            $name = $faker->name;
            $product = new Product();
            $product->name =  $name;
            $product->slug = Str::slug($name, '-');
            $product->category_id = $third_category->subCategory->category->id;
            $product->sub_category_id = $third_category->subCategory->id;
            $product->last_category_id = $third_category->id;
            $product->brand_id = $brand_id;
            $product->short_description = $faker->paragraph($nbSentences = 5, $variableNbSentences = true);
            $product->description = $faker->paragraph($nbSentences = 15, $variableNbSentences = true);
            $product->size_chart = $faker->image('public/images/products/thumb/',300,400, null, false);
            $product->save();
            if ($product) {
                for ($j=0; $j < 2 ; $j++) {
                    $image = $faker->image('public/images/products/thumb/',300,400, null, false);
                    $product_image = new ProductImage();
                    $product_image->image = $image;
                    $product_image->product_id = $product->id;
                    $product_image->save();
                    if ($j == 0) {
                        $product->main_image = $image;
                        $product->save();
                    }
                }

                $size_count = Size::where('sub_category_id',$third_category->subCategory->id)->count();
                if ($size_count > 0) {
                    $size = Size::where('sub_category_id',$third_category->subCategory->id)->get();
                    $min_mrp = 0;
                    $min_rate = 0;
                    $s_c = 0;
                    foreach ($size as $key => $size_data) {
                        if ($s_c < 3) {
                            $mrp = rand(900,2000);
                            $rate = rand(100,$mrp);
                            if (($min_mrp > $mrp) || ($min_mrp == 0)) {
                                $min_mrp = $mrp;
                            }
                            if (($min_rate > $rate) || ($min_rate == 0)) {
                                $min_rate = $rate;
                            }
                            $product_size = new ProductSize();
                            $product_size->size_id = $size_data->id;
                            $product_size->product_id = $product->id;
                            $product_size->mrp = $mrp;
                            $product_size->price = $rate;
                            $product_size->stock = rand(0,50);
                            $product_size->save();
                        }
                        $s_c++;
                    }
                    $product->min_price = $min_rate;
                    $product->mrp = $min_mrp;
                    $product->save();
                }

                $color_count = Color::where('sub_category_id',$third_category->subCategory->id)->count();
                if ($color_count > 0) {
                    $color = Color::where('sub_category_id',$third_category->subCategory->id)->get();
                    $cc =0;
                    foreach ($color as $key => $col) {
                        if ($cc < 3) {
                            $colors = new ProductColor();
                            $colors->color_id = $col->id;
                            $colors->product_id = $product->id;
                            $colors->save();
                        }
                        $cc++;
                    }
                }
            }
            $this->command->info("Seeding Started .................. ($i+1)");
        }

    }
}
