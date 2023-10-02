<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id'             => 1,
                'name'           => 'Category 1',
                'slug'           => 'category-1',
                'description'    => 'Desc category 1',
                'parent_id'      => 0,
                'user_id'        => 1
            ],
            [
                'id'             => 2,
                'name'           => 'Category 1.1',
                'slug'           => 'category-1-1',
                'description'    => 'Desc category 1.1',
                'parent_id'      => 1,
                'user_id'        => 1
            ],
            [
                'id'             => 3,
                'name'           => 'Category 1.1.1',
                'slug'           => 'category-1-1-1',
                'description'    => 'Desc category 1.1.1',
                'parent_id'      => 2,
                'user_id'        => 1
            ],
            [
                'id'             => 4,
                'name'           => 'Category 2',
                'slug'           => 'category-2',
                'description'    => 'Desc category 2',
                'parent_id'      => 0,
                'user_id'        => 1
            ],
            [
                'id'             => 5,
                'name'           => 'Category 2.2',
                'slug'           => 'category-2-2',
                'description'    => 'Desc category 2.2',
                'parent_id'      => 4,
                'user_id'        => 1
            ],
            [
                'id'             => 6,
                'name'           => 'Category 2.2.2',
                'slug'           => 'category-2-2-2',
                'description'    => 'Desc category 2.2.2',
                'parent_id'      => 5,
                'user_id'        => 1
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate($category);
        }
    }
}
