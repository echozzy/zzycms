<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('admin_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title','30')->comment('菜单标题');
            $table->unsignedSmallInteger('list_order')->default(100)->comment('排序');
            $table->unsignedInteger('p_id')->comment('父级ID');
            $table->string('icon','20')->nullable()->comment('菜单图标');
            $table->string('permission','30')->comment('菜单权限标识');
            $table->string('url')->comment('链接地址');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admin_menus');
    }
}