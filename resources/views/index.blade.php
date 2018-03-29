@extends('layouts.master')

@section('body')

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
							@if (session('status'))
				<div class="alert alert-success">
					{{ session('status') }}
				</div>
			@endif
                    <h1 class="page-header">MID SEARCH</h1>
					
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">

                                <div class="col-xs-9 text-left">
                                    <div class="huge">Search MID Database </div>
                                    <div>To Start New Request</div>
                                </div>
								
								<div class="col-xs-3 pull-right">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">

                                <div class="col-xs-9 col-xs-offset-1 text-center">                                  
                                    <input id="itemType"  type="text" placeholder="Search ..." class="form-control"/>
                                </div>
								<div class="col-xs-1">
                                 <a href="#"> <i class="fa fa-search fa-2x"></i></a>
                                </div>
                            </div>
							<div class="row">
							  <div class="col-xs-9 col-xs-offset-1">
						<ul id="myUL">
										
						</ul>
							</div>
							</div>
                        </div>						
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Didn't find your item in the List</span>
                                <a href="{{ route('req.create')}}"><span class="pull-right">Start New Request <i class="fa fa-arrow-circle-right"></i></span></a>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>


            </div>
            <!-- /.row -->
 
        </div>
        <!-- /#page-wrapper -->

@endsection