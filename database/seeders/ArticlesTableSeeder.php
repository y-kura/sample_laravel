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

        $now = new DateTime('-5 year');
        foreach (range(1, 200) as $id) {
            $now->modify('+' . rand(1, 60 * 60 * 24 * 7) . ' second');
            DB::table('articles')->insert([
                'id' => $id,
                'user_id' => $faker->randomElement([1, 2, 3]),
                'title' => $faker->sentence(),
                'body' => implode("\n", $faker->paragraphs()),
                'category_id' => $faker->randomElement([1, 2, 3, 4, 9]),
                'posted_at' => rand(0, 1) ? $faker->dateTimeBetween('-5 year', 'now') : null,
                'public_flag' => $faker->randomElement([true, true, true, true, false]),
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            if (rand(0, 1)) {
                foreach (range(1, rand(1, 5)) as $num) {
                    $now->modify('+' . rand(1, 60 * 60 * 24) . ' second');
                    DB::table('comments')->insert([
                        'user_id' => $faker->randomElement([1, 2, 3]),
                        'article_id' => $id,
                        'text' => $faker->sentence(),
                        'created_at' => $now,
                    ]);
                }
            }

        }
    }
}
