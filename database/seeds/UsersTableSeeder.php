<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         $this->call([
            SubjectsTableTableSeeder::class, // 呼び出すように追加
        ]);

    }
}
