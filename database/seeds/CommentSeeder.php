<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
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
            DB::table('comments')->insert([
                'comment' => $faker->text($maxNbChars = 50),
                'user_id' => $faker->numberBetween($min = DB::table('users')->min('id'), $max = DB::table('users')->max('id')),
                'discussion_id' => $faker->numberBetween($min = DB::table('discussions')->min('id'), $max = DB::table('discussions')->max('id')),
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
