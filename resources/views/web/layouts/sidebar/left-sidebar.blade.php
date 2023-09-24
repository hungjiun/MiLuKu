<aside class="main-sidebar 'sidebar-light-primary elevation-4'">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
        <img src="/web_assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">MiLuKu</span>
    </a>

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column data-widget="treeview" role="menu" data-animation-speed="300" data-accordion="false">
                {{-- Configured sidebar links --}}
                {{-- @each('web.layouts.sidebar.menu-item', $adminlte->menu('sidebar'), 'item') --}}
                {{-- @each('web.layouts.sidebar.menu-item', $menu, 'item') --}}
                {{$menu}}
            </ul>
        </nav>
    </div>

</aside>
