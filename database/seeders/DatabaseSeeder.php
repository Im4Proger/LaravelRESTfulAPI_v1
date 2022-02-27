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
        $goods = \App\Models\Good::factory(10)->create();
        $categories = \App\Models\Category::factory(10)->create();

        foreach ($goods as $good) {
            $category_ids = $categories->random(random_int(2,10))->pluck('id');
            $good->categories()->attach($category_ids);
        }
    }
}
