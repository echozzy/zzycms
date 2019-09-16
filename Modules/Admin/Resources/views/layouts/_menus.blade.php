<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- 使用.nav icon类向链接添加图标 使用字体awesome或任何其他图标字体库 -->
    @if($menus = \ZyModule::getMenus())
    @foreach($menus as $menu)
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon {{$menu['icon']}}"></i>
            <p>
                {{$menu['title']}}
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @foreach($menu['child'] as $item)
            <li class="nav-item">
                <a href="{{$item['url']}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{$item['title']}}</p>
                </a>
            </li>
            @endforeach
        </ul>
    </li>
    @endforeach
    @endif
    <li class="nav-header">杂项</li>
    <li class="nav-item">
        <a href="https://adminlte.io/docs/3.0" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>文档</p>
        </a>
    </li>
</ul>