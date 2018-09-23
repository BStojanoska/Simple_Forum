<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['General', 'Misc', 'Sports', 'Movies', 'Politics', 'Cars'];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'category' => $category
            ]);
        }
    }
}
