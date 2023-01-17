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

        DB::table('users')->insert([
            'over_name' => 'kanri',
            'under_name' => 'suruyo',
            'over_name_kana' => 'かんり',
            'under_name_kana' => 'するよ',
            'mail_address' => 'kanriwosuruyo@gmail.com',
            'sex' => '2',
            'birth_day' => '1995'.'01'.'01',
            'role' => 1,
            'password' => bcrypt('password'),
             ]);
             // 呼び出すように追加

    }
}
