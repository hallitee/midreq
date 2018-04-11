@extends('layouts.master')

@section('navleft')

@parent

@endsection
@section('navright')
@parent
@endsection

@section('body')
@php
$rd = "";
$app="";
if(Auth::user()->isApprover()||Auth::user()->isAdmin()){
	$rd = "readonly";
}
else{
	$rd ="readonly";
	
}
if($req->approved==1){
	$app = 'APPROVED';
}
elseif($req->approved==2){
	$app = 'UNAPPROVED';
}
else
{
	$app = 'AWAITING APPROVAL';
	
}
@endphp

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
				@if(Auth::user()->isApprover()||Auth::user()->isAdmin())
                    <h1 class="page-header">Update Approval </h1>
				@else
					<h1 class="page-header">View Request </h1>
				@endif
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
                       <div class="row">
			{!! Form::open(['action' => array('ReqController@update', $req->id),'method'=>'PUT']) !!}
					<div class="col-lg-8 col-md-8 col-md-offset-3">
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField">Item Type<span class="asteriskField">*</span> </label>
						<div class="controls col-md-5 "  style="margin-bottom: 10px">
						{!! Form::text('itemType',$req->item_type,array('class' => 'input-md form-control', 'id'=>'itemType', $rd)); !!}
				
						<ul id="myUL">
										
						</ul>
					</div>	
					</div>					
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField">Item Description<span class="asteriskField">*</span> </label>
						<div class="controls col-md-5 "  style="margin-bottom: 10px">
						{!! Form::textarea('itemDesc',$req->descr,array('class' => 'input-md form-control', 'placeholder'=>'120mm &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Blue &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 240V &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  2KVA', 'id'=>'itemDesc', 'size'=>'20x5', $rd)); !!}
					
						</div>	
					</div>
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField">Type of Material <span class="asteriskField"></span> </label>
						<div class="controls col-md-5 "  style="margin-bottom: 10px">
						{!! Form::text('matType',$req->mat_type,array('class' => 'input-md form-control', 'id'=>'matType', $rd)); !!}
					</div>	
					</div>	
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField">Brand<span class="asteriskField"></span> </label>
						<div class="controls col-md-5 "  style="margin-bottom: 10px">
						{!! Form::text('brand',$req->brand,array('class' => 'input-md form-control', 'id'=>'brand', $rd)); !!}
					</div>	
					</div>	
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField">Sub Category<span class="asteriskField"></span> </label>
						<div class="controls col-md-5 "  style="margin-bottom: 10px">
						{!! Form::text('midCreator',$req->subcatname,array('class' => 'input-md form-control', 'id'=>'brand', $rd)); !!}
					</div>	
					</div>					
					@if(Auth::user()->isApprover()||Auth::user()->isAdmin())
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField">Date Created<span class="asteriskField"></span> </label>
						<div class="controls col-md-5 "  style="margin-bottom: 10px">
						{!! Form::text('dateCreated',$req->created_at,array('class' => 'input-md form-control', 'id'=>'brand', $rd)); !!}
					</div>	
					</div>
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField">Created By<span class="asteriskField"></span> </label>
						<div class="controls col-md-5 "  style="margin-bottom: 10px">
						{!! Form::text('createdBy',$req->user->email,array('class' => 'input-md form-control', 'id'=>'brand', $rd)); !!}
					</div>	
					</div>				
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField">Approved<span class="asteriskField"></span> </label>
						<div class="controls col-md-5 "  style="margin-bottom: 10px">
						{!! Form::select('approval',['1'=>'APPROVED', '2'=>'UNAPPROVED' ],$req->approved,array( 'class' => 'input-md form-control', 'id'=>'mainCat')); !!}
						</div>	
					</div>	
					@if($req->approved == 0)
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField">Remarks<span class="asteriskField"></span> </label>
						<div class="controls col-md-5 "  style="margin-bottom: 10px">
						{!! Form::textarea('remarks','',array('size'=>'20x3', 'class' => 'input-md form-control', 'id'=>'remarks', 'required')); !!}
					</div>	
					</div>		
					@endif					
					@else
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField">Status<span class="asteriskField"></span> </label>
						<div class="controls col-md-5 "  style="margin-bottom: 10px">
						{!! Form::text('approval',$app,array('class' => 'input-md form-control', 'id'=>'brand', $rd)); !!}
					</div>	
					</div>

					@endif						
						<div id="div_id_select" class="form-group required">
						<label for="id_select"  class="control-label col-md-4  requiredField"><span class="asteriskField"></span> </label>
						@if(Auth::user()->isApprover()||Auth::user()->isAdmin())
							@if($req->approved==1)
								
							@else
						<div class="controls col-md-3 "  style="margin-bottom: 10px">
						{!! Form::submit('SUBMIT', array('class'=>'btn btn-info updateReq')); !!}
						</div>	
						@endif
						@endif						
						<div class="controls col-md-2 "  style="margin-bottom: 10px">
						<a href="{{route('req.index')}}"><button type="button" class="btn btn-info">BACK</button></a>
						</div>								
						
					</div>

						{!! Form::close() !!}
				</div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

@endsection