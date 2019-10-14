<?php
/** .-------------------------------------------------------------------
 * |      Site: www.zhouzy365.com
 * |      Date: 2019/9/10 下午3:13
 * |    Author: zzy <348858954@qq.com>
 * '-------------------------------------------------------------------*/
/**
 * 权限配置
 * 为了避免其他模块有同名的权限，权限标识要以 '控制器@方法' 开始
 * 资源路由控制器增删改查全由@index控制
 */
return [
    [
        'title' => '文章管理',
        'p_id' => 0,
        'name' => 'Article',
        'guard_name' => 'admin',
        'permissions' => [
            ['title' => '文章分类', 'name' => 'Modules\Article\Http\Controllers\AdminCategoryController@index', 'guard_name' => 'admin'],
            ['title' => '文章列表', 'name' => 'Modules\Article\Http\Controllers\AdminArticleController@index', 'guard_name' => 'admin'],
        ],
    ],
];
