<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCategoriesTable extends Migration
{
    //提交
    public function up()
    {
        Schema::create('article_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('p_id')->comment('父级ID');
            $table->string('cat_name','200')->comment('分类名称');
            $table->string('cat_description','255')->comment('分类描述');
            $table->unsignedSmallInteger('list_order')->default(100)->comment('排序');
            $table->timestamps();
        });
    }

    //回滚
    public function down()
    {
        Schema::dropIfExists('article_categories');
    }
}
