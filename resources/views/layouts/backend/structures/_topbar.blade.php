<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                <i class="ti-menu ti-close"></i>
            </a>
            <a class="navbar-brand" href="{{ backendRouter('dashboard') }}">
                <span class="logo-text">
                    <img src="{{ asset('backend/image/logo.png') }}" width="100px" alt="homepage" class="light-logo"/>
                </span>
            </a>
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
               data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
               aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <ul class="navbar-nav float-left mr-auto">
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                        <i class="mdi mdi-menu font-24"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav float-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href=""
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('backend/image/user/1.jpg') }}" alt="user" class="rounded-circle" width="31">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated">
                        <a class="dropdown-item" href="{{ backendRouter('admin.change-password') }}"><i class="ti-user m-r-5 m-l-5"></i>Update password</a>
                        {{--<a class="dropdown-item" href="{{ backendRouter('admin.change-password') }}"><i class="ti-user m-r-5 m-l-5"></i>Update avatar</a>--}}
                        <a class="dropdown-item" href="{{ backendRouter('logout') }}"><i class="ti-user m-r-5 m-l-5"></i>Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
