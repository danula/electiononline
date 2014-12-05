<!DOCTYPE html>
<html lang="en">
<link rel="shortcut icon" href="{{URL::to('resources/favicon.png')}}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta property="og:site_name" content="Chandaya.info | Online Election Portal">
    <meta property="og:title" content="Chandaya.info | Online Election Portal">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://www.chandaya.info">
    <meta property="fb:app_id" content="358727977621649">
    <meta property="og:image" content="{{URL::to('resources/ogImage.png')}}">
    <title>Chandaya.info</title>

    <!-- styles -->
    {{HTML::style("css/bootstrap.min.css");}}
    {{HTML::style("css/plugins/metisMenu/metisMenu.min.css");}}
    {{HTML::style("css/plugins/timeline.css");}}
    {{HTML::style("css/sb-admin-2.css");}}
    {{HTML::style("css/plugins/morris.css");}}
    {{HTML::style("font-awesome-4.2.0/css/font-awesome.min.css");}}

    <style type="text/css">
    .panel-heading a:link, .panel-heading a:hover{
        text-decoration: none;
        display: block;
        width: 100%;
    }

    .table tr{
        padding-left: 10px;
    }
    </style>

    <!-- scripts -->
    {{HTML::script("https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js");}}
    {{HTML::script("https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js");}}



    <!-- jQuery -->
    {{HTML::script("js/jquery.js");}}

    @yield('scripts')
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
        <div class="panel-group" id="accordion">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="active" href="{{URL::to('')}}"><i class="fa fa-home fa-fw"></i> Home</a>
                    </h4>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapseTwo"><i class="fa fa-map-marker fa-fw"></i> Results by Location</a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>
                                    <a href="{{URL::to('districtresult/Colombo/2010')}}">District</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="{{URL::to('seatresult/Colombo%20North/2010')}}">Seat</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapseThree"><i class="fa fa-calendar fa-fw"></i> Results by Year</a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>
                                    <a href="{{URL::to('plotbyyear/1982')}}">1982</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="{{URL::to('plotbyyear/1988')}}">1988</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="{{URL::to('plotbyyear/1994')}}">1994</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="{{URL::to('plotbyyear/1999')}}">1999</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="{{URL::to('plotbyyear/2005')}}">2005</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="{{URL::to('plotbyyear/2010')}}">2010</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="{{URL::to('districtplot/Colombo')}}"><i class="fa fa-area-chart fa-fw"></i> Analytics</a>
                    </h4>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="{{URL::to('candidate/2010/Mahinda%20Rajapaksha')}}"><i class="fa fa-users fa-fw"></i> Candidates</a>
                    </h4>
                </div>
            </div>
        </div>
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

   <footer class="page-footer sticky-footer">
       <div class="container-fluid">
           <div class="clearfix">
               <hr/>
               <p style="text-align: center; font-style: italic">All material provided on the Site is intended for informational purposes only and should not be used to replace official documents</p>
   		       <p style="text-align: center; font-style: italic">Contact developers: <a href="mailto:info@chandaya.info">info@chandaya.info</a></p>
           </div>
       </div>
   </footer>
</body>

</html>
