<aside class="left-sidebar" data-sidebarbg="skin5">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ backendRouter('dashboard') }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ backendRouter('user.list') }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">User</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ backendRouter('category.list') }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Category</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ backendRouter('post.list') }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Post</span>
                    </a>
                </li>

                {{--<li class="sidebar-item">--}}
                    {{--<a class="sidebar-link has-arrow waves-effect waves-dark"--}}
                       {{--href="javascript:void(0)" aria-expanded="false">--}}
                        {{--<i class="mdi mdi-alert"></i>--}}
                        {{--<span class="hide-menu">Errors </span>--}}
                    {{--</a>--}}
                    {{--<ul aria-expanded="false" class="collapse first-level">--}}
                        {{--<li class="sidebar-item">--}}
                            {{--<a href="" class="sidebar-link">--}}
                                {{--<i class="mdi mdi-alert-octagon"></i>--}}
                                {{--<span class="hide-menu"> Error 403</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="sidebar-item">--}}
                            {{--<a href="" class="sidebar-link">--}}
                                {{--<i class="mdi mdi-alert-octagon"></i>--}}
                                {{--<span class="hide-menu"> Error 404</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            </ul>
        </nav>
    </div>
</aside>
