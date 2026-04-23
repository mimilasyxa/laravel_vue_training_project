<?php

namespace Database\Seeders;

use App\Models\Category\Category;
use App\Models\Product\Product;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProductAndCategorySeeder extends Seeder
{
    public const int CATEGORIES_COUNT = 50;
    public const int PRODUCTS_COUNT = 30;
    public function __construct(
        protected Generator $faker,
    )
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->truncateDB();

        for ($i = 0; $i < self::CATEGORIES_COUNT; $i++) {
            $category = new Category();
            $category->setName($this->faker->word);
            $category->setDescription($this->faker->text);
            $category->save();

            $now = Carbon::now();
            $productsData = [];
            foreach (range(1, self::PRODUCTS_COUNT) as $index) {
                $productsData[] = [
                    'category_id' => $category->getId(),
                    'name' => $this->faker->word,
                    'price' => $this->faker->randomFloat(2, 10, 10000),
                    'description' => $this->faker->text,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            Product::query()->insert($productsData);
        }
    }

    private function truncateDB(): void
    {
        DB::table("products")->truncate();
        DB::table("categories")->truncate();
    }
}
