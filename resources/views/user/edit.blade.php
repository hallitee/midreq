@extends('layouts.master')

@section('navleft')

@parent

@endsection
@section('navright')
@parent
@endsection



@section('body')

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Manage Users</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
																		
            <!-- /.row -->
            <div class="row">
			{!! Form::open(['action' => array('userController@update', $s->id),'method'=>'PUT']) !!}
					<div class="col-lg-8 col-md-8 col-md-offset-2">
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField">User Name<span class="asteriskField">*</span> </label>
						<div class="controls col-md-5 "  style="margin-bottom: 10px">
						{!! Form::text('uName',$s->name,array('class' => 'input-md form-control', 'id'=>'lnkName', 'required')); !!}
						</div>	
					</div>					
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField">User Email<span class="asteriskField">*</span> </label>
						<div class="controls col-md-5 "  style="margin-bottom: 10px">
						{!! Form::email('uEmail',$s->email,array('class' => 'input-md form-control', 'id'=>'lnkName', 'required')); !!}
						</div>	
					</div>
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField">Password<span class="asteriskField">*</span> </label>
						<div class="controls col-md-5 "  style="margin-bottom: 10px">
						{!! Form::password('uPwd',array('class' => 'input-md form-control', 'id'=>'lnkName', 'required')); !!}
						</div>	
					</div>	
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField">Company<span class="asteriskField"></span> </label>
						<div class="controls col-md-5 "  style="margin-bottom: 10px">
						{!! Form::text('company',$s->company,array( 'class' => 'input-md form-control', 'id'=>'mainCat')); !!}
						</div>	
					</div>					
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField">Approver<span class="asteriskField"></span> </label>
						<div class="controls col-md-5 "  style="margin-bottom: 10px">
						{!! Form::select('approver',['1'=>'YES', '0'=>'NO'],$s->approver,array( 'class' => 'input-md form-control', 'id'=>'mainCat')); !!}
						</div>	
					</div>						
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField"><span class="asteriskField"></span> </label>
						<div class="controls col-md-8 "  style="margin-bottom: 10px">
						{!! Form::submit('UPDATE', array('class'=>'btn btn-info')); !!}
						</div>						
					</div>

						{!! Form::close() !!}
				</div>
            </div>
            <!-- /.row -->
            </div>
            <!-- /.row -->
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

@endsection