<?php
/** .-------------------------------------------------------------------
 * |      Site: www.hdcms.com  www.houdunren.com
 * |      Date: 2018/7/2 上午12:54
 * |    Author: 向军大叔 <2300071698@qq.com>
 * '-------------------------------------------------------------------*/
/**
 * 后台菜单配置
 * 下面是属性说明：
 * title 菜单栏目
 * icon 图标参考 http://fontawesome.dashgame.com/
 * menus 子菜单
 * permission 权限标识，必须在permission.php配置文件中存在
 */
return [
    'Admin'=>[
        "title"      => "系统管理",
        "icon"       => "fa fa-cogs",
        'permission' => '权限标识',
        "menus"      => [
            ["title" => "网站信息", "permission" => "权限标识", "url" => "链接地址"],
            ["title" => "邮箱配置", "permission" => "权限标识", "url" => "链接地址"],
            ["title" => "友情链接", "permission" => "权限标识", "url" => "链接地址"],
        ],
    ],
    'Role'=>[
        "title"      => "权限管理",
        "icon"       => "fas fa-user-shield",
        'permission' => '权限标识',
        "menus"      => [
            ["title" => "管理员列表", "permission" => "权限标识", "url" => "链接地址"],
            ["title" => "管理员日志", "permission" => "权限标识", "url" => "链接地址"],
            ["title" => "角色管理", "permission" => "权限标识", "url" => "/admin/role"],
            ["title" => "权限管理", "permission" => "权限标识", "url" => "/admin/role"],
        ],
    ],
];
