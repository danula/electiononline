<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        @yield('meta')
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="">
        <meta property="og:site_name" content="Chandaya.info | Online Election Portal">
        <meta property="og:title" content="Chandaya.info | Online Election Portal">
        <meta property="og:type" content="website">
        <meta property="og:url" content="http://www.chandaya.info">
        <meta property="fb:app_id" content="358727977621649">
        <meta property="og:image" content="{{URL::to('resources/ogImage.png')}}">
        <link rel="shortcut icon" href="{{URL::to('resources/favicon.png')}}">

        <!-- styles -->
        {{HTML::style("//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css");}}
        {{HTML::style("font-awesome-4.2.0/css/font-awesome.min.css");}}
        {{HTML::style("//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css");}}
        {{HTML::style('css/theme.css')}}
        {{HTML::style("css/morris/morris.css");}}

        <!--[if lt IE 9]>
          {{HTML::script("https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js");}}
          {{HTML::script("https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js");}}
        <![endif]-->
        {{HTML::script("//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js");}}
        {{HTML::script("//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js");}}
        {{HTML::script("../../js/AdminLTE/app.js");}}

        @yield('scripts')
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="/" class="logo">
                Chandaya.info
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown">
                            <a href="http://forum.chandaya.info">
                                <i class="fa fa-comments fa-fw"></i>Forum
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li>
                            <a href="{{URL::to('')}}">
                                <i class="fa fa-home fa-fw"></i> <span>Home</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-map-marker fa-fw"></i>
                                <span>Results by Location</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{URL::to('districtresult/Colombo/2010')}}"><i class="fa fa-angle-double-right"></i> District</a></li>
                                <li><a href="{{URL::to('seatresult/Colombo%20North/2010')}}"><i class="fa fa-angle-double-right"></i> Seat</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-calendar fa-fw"></i>
                                <span>Results by Year</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{URL::to('plotbyyear/1982')}}"><i class="fa fa-angle-double-right"></i> 1982</a></li>
                                <li><a href="{{URL::to('plotbyyear/1988')}}"><i class="fa fa-angle-double-right"></i> 1988</a></li>
                                <li><a href="{{URL::to('plotbyyear/1994')}}"><i class="fa fa-angle-double-right"></i> 1994</a></li>
                                <li><a href="{{URL::to('plotbyyear/1999')}}"><i class="fa fa-angle-double-right"></i> 1999</a></li>
                                <li><a href="{{URL::to('plotbyyear/2005')}}"><i class="fa fa-angle-double-right"></i> 2005</a></li>
                                <li><a href="{{URL::to('plotbyyear/2010')}}"><i class="fa fa-angle-double-right"></i> 2010</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{URL::to('districtplot/Colombo')}}">
                                <i class="fa fa-area-chart fa-fw"></i> <span>Analytics</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::to('candidate/2010/Mahinda%20Rajapaksha')}}">
                                <i class="fa fa-users fa-fw"></i> <span>Candidates</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::to('predict/1')}}">
                                <i class="fa fa-gear fa-fw"></i> <span>Predict 2015</span>
                                <small class="badge pull-right bg-red">new</small>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <div class="container-fluid">
                <!-- Main content -->
                @yield('content')
                    <footer class="page-footer sticky-footer">
                       <div class="container-fluid">
                           <div class="clearfix">
                               <hr/>
                               <div class="col-md-12">
                                   <p>All material provided on the Site is intended for informational purposes only and should not be used to replace official documents</p>
                                   <div class="pull-right">
                                      <div id="fb-root"></div>
                                      <div class="fb-like" data-share="true" data-width="450" data-show-faces="true"></div>
                                   </div>
                                   <p>Contact developers: <a href="mailto:info@chandaya.info">info@chandaya.info</a></p>
                               </div>
                           </div>
                       </div>
                   </footer>
                </div>
                <!-- /. Main content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->







        <!-- /#page-wrapper -->


        <!-- /#wrapper -->

        <!-- facebook -->
        <script>
          window.fbAsyncInit = function() {
            FB.init({
              appId      : '358727977621649',
              xfbml      : true,
              version    : 'v2.2'
            });
          };
          (function(d, s, id){
             var js, fjs = d.getElementsByTagName(s)[0];
             if (d.getElementById(id)) {return;}
             js = d.createElement(s); js.id = id;
             js.src = "//connect.facebook.net/en_US/sdk.js";
             fjs.parentNode.insertBefore(js, fjs);
           }(document, 'script', 'facebook-jssdk'));
        </script>
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
          ga('create', 'UA-57298944-1', 'auto');
          ga('require', 'displayfeatures');
          ga('send', 'pageview');
        </script>
    </body>
</html>
