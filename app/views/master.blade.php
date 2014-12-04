<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Chandaya.info</title>

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


    @yield('scripts')
    <!-- jQuery -->
    {{HTML::script("js/jquery.js");}}
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
        <a class="navbar-brand" href="/">Chandaya.info</a>
    </div>

    <ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
        <a href="http://forum.chandaya.info">
            <i class="fa fa-comments fa-fw"></i>Forum
        </a>

    </li>
    </ul>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a class="active" href="{{URL::to('')}}"><i class="fa fa-dashboard fa-fw"></i> Overall Summary</a>
                </li>
                <li>
                    <a><i class="fa fa-table fa-fw"></i> Results by Location</a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{URL::to('districtresult/Colombo/2010')}}">District</a>
                        </li>
                        <li>
                            <a href="{{URL::to('seatresult/Colombo%20North/2010')}}">Seat</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a><i class="fa fa-bar-chart-o fa-fw"></i> Summary of Elections</a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{URL::to('plotbyyear/1982')}}">1982</a>
                        </li>
                        <li>
                            <a href="{{URL::to('plotbyyear/1988')}}">1988</a>
                        </li>
                        <li>
                            <a href="{{URL::to('plotbyyear/1994')}}">1994</a>
                        </li>
                        <li>
                            <a href="{{URL::to('plotbyyear/1999')}}">1999</a>
                        </li>
                        <li>
                            <a href="{{URL::to('plotbyyear/2005')}}">2005</a>
                        </li>
                        <li>
                            <a href="{{URL::to('plotbyyear/2010')}}">2010</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{URL::to('districtplot/Colombo')}}"><i class="fa fa-bar-chart-o fa-fw"></i> Analytics</a>
                </li>
                <li>
                    <a href="{{URL::to('candidate/2010/Mahinda%20Rajapaksha')}}"><i class="fa fa-bar-chart-o fa-fw"></i> Candidates</a>
                 </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>

</nav>

<div id="page-wrapper">

@yield('content')
<div id="fb-root"></div>
<div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>

</div>


<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Bootstrap Core JavaScript -->
{{HTML::script("js/bootstrap.min.js");}}

<!-- Metis Menu Plugin JavaScript -->
{{HTML::script("js/plugins/metisMenu/metisMenu.min.js");}}

<!-- Morris Charts JavaScript -->
{{HTML::script("js/plugins/morris/raphael.min.js");}}
{{HTML::script("js/plugins/morris/morris.min.js");}}
{{HTML::script("js/plugins/morris/morris-data.js");}}


{{HTML::script("js/sb-admin-2.js");}}

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
  ga('send', 'pageview');

</script>

    <div id="footer">
      <div class="col-lg-12">
        <p class="muted credit" style="text-align: center">Contact developers: electiononlinelk@gmail.com</p>
      </div>
    </div>
</body>

</html>
