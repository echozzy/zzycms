<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $users = factory(\Modules\Admin\Model\AdminUsers::class,4)->create();
        $user = $users[0];
        $user->user_name = 'admin';
        $user->nick_name = '超级管理员';
        $user->save();
        Role::create([
            'title'=>'超级管理员',
            'name'=>'Administrators',
            'guard_name'=>'admin'
        ]);
        $user->assignRole('Administrators');
    }
}
