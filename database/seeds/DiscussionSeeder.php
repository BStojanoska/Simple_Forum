<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;

class DiscussionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 10; $i++) {
            DB::table('discussions')->insert([
                'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'photo' => Storage::disk('public')->putFile('photos', new File($faker->image($dir = 'storage','640', '480'))),
                'description' => $faker->text($maxNbChars = 300),
                'user_id' => $faker->numberBetween($min = DB::table('users')->min('id'), $max = DB::table('users')->max('id')),
                'category_id' => $faker->numberBetween($min = DB::table('categories')->min('id'), $max = DB::table('categories')->max('id')),
                'is_approved' => $faker->numberBetween($min = 0, $max = 1),
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
