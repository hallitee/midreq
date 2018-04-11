<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MID REQUEST</title>

    <!-- Bootstrap Core CSS -->
	
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{asset('vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('dist/css/sb-admin-2.css')}}" rel="stylesheet">
	<link href="{{asset('dist/css/bootstrap-dialog.min.css')}}" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="{{asset('vendor/morrisjs/morris.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                <a class="navbar-brand" href="{{url('/')}}">MID REQUEST</a>
            </div>
            <!-- /.navbar-header -->
@section('navright')

						
            <ul class="nav navbar-top-links navbar-right">
			  @if (Auth::guest())

                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <b> {{ Auth::user()->name }} </b>
                    </a>
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="divider"></li>
                        <li>
                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        <i class="fa fa-sign-out fa-fw"></i></a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>						
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
						@endif
            </ul>
            <!-- /.navbar-top-links -->
	
			@show
@section('navleft')
	
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

						@if((Auth::check()) && Auth::user()->isAdmin())				
		                        <li>
									<a href="{{ url('home') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
								</li>
                                <li>
                                    <a href="#"><i class="fa fa-book fa-fw"></i>Requests<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="{{ route('req.index') }}">Approve Requests</a>
                                        </li>
                                    </ul>
              
                                </li>								
							<li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i>Master Config<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">MID Creator<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="{{ route('config.create') }}">Create Email</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('config.index') }}">Manage Emails</a>
                                        </li>
                                    </ul>
                           
                                </li>   
                                <li>
                                    <a href="#">Manage User<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="{{ route('user.create') }}">Create User</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('user.index') }}">Manage Users</a>
                                        </li>
                                    </ul>
                           
                                </li> 								
								</ul>
								</li>
								
								<!--				
							<li>
                                    <a href="#"> Add Group <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="{{ route('group.create')}}">Create Group</a>
                                        </li>
                                        <li>
                                            <a href="{{route('group.index')}}">Manage Group</a>
                                        </li>
                                    </ul>
                                
                                </li> 								
                           <li>
                                    <a href="#"> Add Family <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="{{route('family.create') }}">Create Family</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('family.index') }}">Manage Families</a>
                                        </li>
                                    </ul>
                              
                                </li>	
                                <li>
                                    <a href="#"> Add Category <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="{{ route('category.create') }}">Create Category</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('category.index') }}">Manage Categories</a>
                                        </li>
                                    </ul>
                             
                                </li>	
                                <li>
                                    <a href="#"> Add Sub-Category<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="{{ route('subcategory.create') }}">Create Sub-Category</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('subcategory.index') }}">Manage Sub-Category</a>
                                        </li>
                                    </ul>
                                  
                                </li> -->
								
													
								@elseif((Auth::check()) && Auth::user()->isApprover())
		                        <li>
									<a href="{{ url('home') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
								</li>								
                                <li>
                                    <a href="#"><i class="fa fa-book fa-fw"></i>Requests<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="{{ route('req.index') }}">Approve Requests</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>		
								@elseif(Auth::check())	
		                        <li>
									<a href="{{ url('home') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
								</li>
                                <li>
                                    <a href="#"><i class="fa fa-book fa-fw"></i>Requests<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="{{ route('req.index') }}">View Requests</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>								
								@endif								

                          
                            <!-- /.nav-second-level -->
                       

                    </ul>
					</li>
                </div>
                <!-- /.sidebar-collapse -->
            </div>

            <!-- /.navbar-static-side -->
			@show
        </nav>
		
@yield('body')
@if($t)
<script type="text/javascript">


</script>
@endif
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset('vendor/metisMenu/metisMenu.min.js')}}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{asset('vendor/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('vendor/morrisjs/morris.min.js')}}"></script>
    <script src="{{asset('data/morris-data.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('dist/js/test.js')}}"></script>
    <script src="{{asset('dist/js/bootstrap-dialog.min.js')}}"></script>
</body>

</html>
