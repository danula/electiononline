<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- styles -->
    {{HTML::style("css/bootstrap.min.css");}}
    {{HTML::style("css/plugins/metisMenu/metisMenu.min.css");}}
    {{HTML::style("css/plugins/timeline.css");}}
    {{HTML::style("css/sb-admin-2.css");}}
    {{HTML::style("css/plugins/morris.css");}}
    {{HTML::style("font-awesome-4.1.0/css/font-awesome.min.css");}}

    <!-- scripts -->
    {{HTML::script("https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js");}}
    {{HTML::script("https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js");}}
</head>

<body>

<div id="wrapper">

<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">Election Online</a>
    </div>

    <ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
            </li>
            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
            </li>
            <li class="divider"></li>
            <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </li>
        </ul>
    </li>
    </ul>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a class="active" href="index.html"><i class="fa fa-dashboard fa-fw"></i> Overall Summary</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Location<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="flot.html">District</a>
                        </li>
                        <li>
                            <a href="morris.html">Seat</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Year<span class="fa arrow"></span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Party<span class="fa arrow"></span></a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>

</nav>

<div id="page-wrapper">

@yield('content')


</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
{{HTML::script("js/jquery.js");}}

<!-- Bootstrap Core JavaScript -->
{{HTML::script("js/bootstrap.min.js");}}

<!-- Metis Menu Plugin JavaScript -->
{{HTML::script("js/plugins/metisMenu/metisMenu.min.js");}}

<!-- Morris Charts JavaScript -->
{{HTML::script("js/plugins/morris/raphael.min.js");}}
{{HTML::script("js/plugins/morris/morris.min.js");}}
{{HTML::script("js/plugins/morris/morris-data.js");}}


{{HTML::script("js/sb-admin-2.js");}}
</body>

</html>
