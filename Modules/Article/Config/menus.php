<?php
/** .-------------------------------------------------------------------
 * |      Site: www.zhouzy365.com
 * |      Date: 2019/9/10 下午3:13
 * |    Author: zzy <348858954@qq.com>
 * '-------------------------------------------------------------------*/
/**
 * 后台菜单配置
 * 下面是属性说明：
 * title 菜单栏目
 * p_id 父级菜单
 * icon 图标参考 https://fontawesome.com 或 http://www.fontawesome.com.cn
 * permission 权限标识，必须在permission.php配置文件中存在
 * url 菜单地址
 * menus 子菜单
 */
return [
    [
        "title"      => "文章管理",
        "p_id"        => 0,//父级ID
        "icon"       => "fas fa-file-alt",
        'permission' => 'Article',
        "url" => "/article/admin_article",
        "menus"      => [
            ["title" => "文章分类", "icon"=> "fa fa-navicon", "permission" => "Modules\Article\Http\Controllers\AdminCategoryController@index", "url" => "/article/admin_category"],
            ["title" => "文章列表", "icon"=> "fa fa-navicon", "permission" => "Modules\Article\Http\Controllers\AdminArticleController@index", "url" => "/article/admin_article"],
        ],
    ],
];
