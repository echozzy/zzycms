$(".nav-sidebar li.nav-item.has-treeview").click(function () {
    // 当前菜单无打开属性删除其他菜单的打开选择属性
    if(!$(this).hasClass('menu-open')){
        let i = $(".nav-sidebar li.nav-item.has-treeview").index(this);
        sessionStorage.setItem('current_menu_index', i);
        // 删除其他菜单属性
        $(".nav-sidebar li.nav-item.has-treeview").removeClass('menu-open');
        $(".nav-sidebar li.nav-item.has-treeview a").removeClass('active');
        $(".nav-sidebar li.nav-item.has-treeview ul").hide();
        // 当前菜单添加属性
        $(this).children('a').addClass('active');
        $(this).children('ul').show();
    }
});
let currentMenuIndex = sessionStorage.getItem('current_menu_index');
let nowCurrent = $(".nav-sidebar li.nav-item.has-treeview").eq(currentMenuIndex);
nowCurrent.addClass('menu-open');
nowCurrent.children('a').addClass('active');
nowCurrent.children('ul').show();

$(".nav-sidebar ul li a").click(function(){
    if(!$(this).hasClass('active')){
        let ii = $(".nav-sidebar ul li a").index(this);
        sessionStorage.setItem('current_menu_child_index', ii);
        $(".nav-sidebar ul li a").removeClass('active');
        $(this).addClass('active');
    }
});
let currentMenuChildIndex = sessionStorage.getItem('current_menu_child_index');
$(".nav-sidebar ul li a").eq(currentMenuChildIndex).addClass('active');
