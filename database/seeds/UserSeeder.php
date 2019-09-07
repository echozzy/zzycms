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
        $users = factory(\App\User::class,10)->create();
        $user = $users[0];
        $user->name = 'zzy';
        $user->email = '348858954@qq.com';
        $user->nick_name = 'zzyecho';
        $user->save();
    }
}
