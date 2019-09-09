<?php

use Modules\Admin\Model\AdminUsers;
use Faker\Generator as Faker;

$factory->define(AdminUsers::class, function (Faker $faker) {
    return [
        'user_name' => $faker->name,
        'nick_name' => $faker->name,
        'password' => bcrypt("admin888"), // password
        'remember_token' => Str::random(10),
    ];
});
