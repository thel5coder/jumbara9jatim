<?php
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\Models\User();
        $user->name = 'Kota Surabaya';
        $user->user_name = '020601';
        $user->password = bcrypt('jumbara9');
        $user->user_level_id = 2;
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();
    }
}
