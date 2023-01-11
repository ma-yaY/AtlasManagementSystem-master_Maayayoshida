<?php

use Illuminate\Database\Seeder;
use App\Models\Users\Subjects;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            'Japanese' => '1',
            'Math' => '2',
            'English' => '3',
        ]);
        // 国語、数学、英語を追加
    }
}
