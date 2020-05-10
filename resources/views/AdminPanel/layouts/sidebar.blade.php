<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('adminDashboard')}}" class="brand-link">
        <img src="{{url('dashboard')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Quick App</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
{{--                <li class="nav-item has-treeview">--}}
{{--                    <a href="#" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-blog"></i>--}}
{{--                        <p>--}}
{{--                            Blog--}}
{{--                            <i class="fas fa-angle-right right"></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('blog.index')}}" class="nav-link">--}}
{{--                                <i class="far  fa-eye"></i>--}}
{{--                                <p>All Blog</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('blog.create')}}" class="nav-link">--}}
{{--                                <i class="far fa  fa-plus"></i>--}}
{{--                                <p>Add Blog</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}


                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cart-plus"></i>
                        <p>
                            Main Category
                            <i class="fas fa-angle-right right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('MainCategory.index')}}" class="nav-link">
                                <i class="far  fa-eye"></i>
                                <p>All</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('MainCategory.create')}}" class="nav-link">
                                <i class="far fa  fa-plus"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                    </ul>
                </li>


{{--                <li class="nav-item has-treeview">--}}
{{--                    <a href="#" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-server"></i>--}}
{{--                        <p>--}}
{{--                            Services--}}
{{--                            <i class="fas fa-angle-right right"></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('service.index')}}" class="nav-link">--}}
{{--                                <i class="far  fa-eye"></i>--}}
{{--                                <p>All Services</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('service.create')}}" class="nav-link">--}}
{{--                                <i class="far fa  fa-plus"></i>--}}
{{--                                <p>Add Service</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}



              {{--  <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-inbox"></i>
                        <p>
                            Messages
                            <i class="fas fa-angle-right right"></i>
                            <span class="badge badge-info right" id="messageCount"></span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('listMessages',['type'=>0])}}" class="nav-link">
                                <i class="far  fa-eye"></i>
                                <p>Unread Messages</p>
                                <span class="badge badge-info right" id="messageCount2"></span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('listMessages',['type'=>1])}}" class="nav-link">
                                <i class="far  fa-eye"></i>
                                <p>Readed Messages</p>
                            </a>
                        </li>

                    </ul>
                </li>--}}

                <li class="nav-item">
                    <a href="{{route('profile')}}" class="nav-link">
                        <i class="nav-icon fas fa-user-edit"></i>
                        <p>Profile</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
