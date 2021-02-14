<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['id' => 1, 'name' => '一般'],
            ['id' => 2, 'name' => '政治・経済'],
            ['id' => 3, 'name' => 'エンタメ・スポーツ'],
            ['id' => 4, 'name' => 'IT・科学'],
            ['id' => 9, 'name' => 'その他'],
        ]);
    }
}
