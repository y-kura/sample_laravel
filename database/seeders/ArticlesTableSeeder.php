<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Datetime;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ja_JP');
        foreach (range(1, 100) as $i) {
            DB::table('articles')->insert([
                'user_id' => $faker->randomElement([1, 2, 3]),
                'title' => $faker->sentence(),
                'body' => implode("\n", $faker->paragraphs()),
                'category_id' => $faker->randomElement([1, 2, 3, 4, 9]),
                'posted_at' => rand(0, 1) ? $faker->dateTimeBetween('-5 year', 'now') : null,
                'public_flag' => $faker->randomElement([true, true, true, true, false]),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);
        }
    }
}
