<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'story',
        ]);
        Category::create([
            'name' => 'poem',
        ]);
        Category::create([
            'name' => 'programming',
        ]);
        Category::create([
            'name' => 'fun',
        ]);
        Category::create([
            'name' => 'cartoon',
        ]);
    }
}
