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
                    <h1 class="page-header">Create New User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
			{!! Form::open(['action' => 'userController@store']) !!}
					<div class="col-lg-8 col-md-8 col-md-offset-2">
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField">User Name<span class="asteriskField">*</span> </label>
						<div class="controls col-md-5 "  style="margin-bottom: 10px">
						{!! Form::text('uName',"",array('class' => 'input-md form-control', 'id'=>'lnkName', 'required')); !!}
						</div>	
					</div>					
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField">User Email<span class="asteriskField">*</span> </label>
						<div class="controls col-md-5 "  style="margin-bottom: 10px">
						{!! Form::email('uEmail',"",array('class' => 'input-md form-control', 'id'=>'lnkName', 'required')); !!}
						</div>	
					</div>
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField">Password<span class="asteriskField">*</span> </label>
						<div class="controls col-md-5 "  style="margin-bottom: 10px">
						{!! Form::password('uPwd',array('class' => 'input-md form-control', 'id'=>'lnkName', 'required')); !!}
						</div>	
					</div>	
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField">Approver<span class="asteriskField"></span> </label>
						<div class="controls col-md-5 "  style="margin-bottom: 10px">
						{!! Form::select('approver',['1'=>'YES', '0'=>'NO'],0,array( 'class' => 'input-md form-control', 'id'=>'mainCat')); !!}
						</div>	
					</div>
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField">Sub Category<span class="asteriskField"></span> </label>
						<div class="controls col-md-5 "  style="margin-bottom: 10px">
						{!! Form::select('subCat',$subcat,'',array( 'class' => 'input-md form-control', 'id'=>'mainCat')); !!}
						</div>	
					</div>					
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField"><span class="asteriskField"></span> </label>
						<div class="controls col-md-8 "  style="margin-bottom: 10px">
						{!! Form::submit('SAVE', array('class'=>'btn btn-info')); !!}
						</div>						
					</div>

						{!! Form::close() !!}
				</div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

@endsection