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
        DB::table('Subjects')->insert([

            ['id' => '1',
            'subject' => '国語',
            'created_at' => date('Y-m-d H:i:s')],

            ['id' => '2',
            'subject' => '数学',
            'created_at' => date('Y-m-d H:i:s')],

            ['id' => '3',
            'subject' => '英語',
            'created_at' => date('Y-m-d H:i:s')]
        ]);
        // 国語、数学、英語を追加
    }
}
