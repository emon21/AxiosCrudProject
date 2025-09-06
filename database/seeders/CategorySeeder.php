<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = ['PHP', 'Laravel', 'Java Script', 'Python', 'Java'];

        //for loop
        for ($i = 0; $i < count($categories); $i++) {
            $category = new Category();
            $category->name = $categories[$i];
            $category->save();
        }
    }
}
