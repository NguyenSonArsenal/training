<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">

        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu tree" data-widget="tree">
            <!-- Admin -->

            <?php $admin = Auth::guard('admins')->user(); ?>

            @if ($admin->role_type == config('settings.role_type.superadmin.id'))
                <li class="{{ isset($activeSidebar) && $activeSidebar == 'admin_page' ? 'side_bar_active' : '' }}">
                    <a href="{{ route('superadmin.home') }}">
                        <i class="fa fa-table"></i> <span>Manage admin</span>
                    </a>
                </li>

                <li class="{{ isset($activeSidebar) && $activeSidebar == 'statistic_page' ? 'side_bar_active' : '' }}">
                    <a href="javascript:void(0)">
                        <i class="fa fa-table"></i> <span>Statistic</span>
                    </a>
                </li>
            @elseif ($admin->role_type == config('settings.role_type.admin.id'))
                <li class="{{ isset($activeSidebar) && $activeSidebar == 'admin_page' ? 'side_bar_active' : '' }}">
                    <a href="javascript:void(0)">
                        <i class="fa fa-table"></i> <span>My account</span>
                    </a>
                </li>
                <li class="{{ isset($activeSidebar) && $activeSidebar == 'manage.user.page' ? 'side_bar_active' : '' }}">
                    <a href="javascript:void(0)">
                        <i class="fa fa-table"></i> <span>Manage user</span>
                    </a>
                </li>
            @endif

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>