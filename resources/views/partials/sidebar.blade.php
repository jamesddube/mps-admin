<!-- begin #sidebar -->
<div id="sidebar" class="sidebar sidebar-grid">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;"><img src="{{ url('assets/img/user-13.jpg')}}"  height="50" width="50" alt="user picture" /></a>
                </div>
                <div class="info">
                    <?php $user = Auth::user();
                    echo $user->name." ".$user->surname;
                    ?>

                    <small>Developer</small>
                </div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">Navigation</li>
            <li class="active"><a href="{{ url('') }}"><i class="fa fa-laptop"></i> <span>Dashboard</span></a></li>
            <li><a href="{{ url('/salesreps') }}"><i class="fa fa-user"></i> <span>Sales Reps</span></a></li>
            <li><a href="{{ url('/orders') }}"><i class="fa fa-laptop"></i> <span>Presell Sheets</span></a></li>
            <li><a href="{{ url('/orders') }}"><i class="fa fa-laptop"></i> <span>Orders</span></a></li>
            <li><a href="{{ url('/products') }}"><i class="fa fa-cube"></i> <span>Products</span></a></li>
            <li><a href="{{ url('/customers') }}"><i class="fa fa-building"></i> <span>Customers</span></a></li>
            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-ge"></i>
                    <span>Business Intelligence</span>
                </a>
                <ul class="sub-menu">
                    <li><a href="" target="_blank">Sales</a></li>
                    <li><a href="" target="_blank">Map Matrix</a></li>
                    <li><a href="" target="_blank">Top Performers</a></li>
                </ul>
            </li>
            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Reports</span>
                </a>
                <ul class="sub-menu">
                    <li><a href="email_system.html">System Template</a></li>
                    <li><a href="email_newsletter.html">Newsletter Template</a></li>
                </ul>
            </li>
            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-cogs"></i>
                    <span>Settings</span>
                </a>
                <ul class="sub-menu">
                    <li><a href="{{ url('users/create') }}"><span>New User<i class="fa text-theme fa-star m-l-5"></i></span></a></li>
                    <li><a href="{{ url('users') }}">View Users</a></li>
                    <li><a href="#"><span>Data Sources<i class="fa text-theme fa-database m-l-5"></i></span></a></li>
                    <li><a href="email_newsletter.html">Newsletter Template</a></li>
                </ul>
            </li>

            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->