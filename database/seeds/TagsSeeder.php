<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'name' => 'aaa',
        ]);
        Tag::create([
            'name' => 'bbb',
        ]);
        Tag::create([
            'name' => 'ccc',
        ]);
        Tag::create([
            'name' => 'ddd',
        ]);
    }
}
