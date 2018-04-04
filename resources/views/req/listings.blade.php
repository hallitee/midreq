
<table class="table table-responsive table-dark table-bordered">
  <thead>
  @if(Auth::check() && Auth::user()->isApprover())
    <tr>
      <th scope="col">S/N</th>
      <th scope="col">Item Type</th>    
      <th scope="col">Item Description</th>
      <th scope="col">Date Created</th>	  
      <th scope="col">Created by</th>    
      <th scope="col">MID Creator ({{Auth::user()->company}})</th>  	  
      <th scope="col">Status</th>	  
      <th scope="col">Approve</th>	 	       
    </tr>
	@else
    <tr>
      <th scope="col">S/N</th>
      <th scope="col">Item Type</th>    
      <th scope="col">Item Description</th>
      <th scope="col">Date Created</th>    
      <th scope="col">Approval Status</th>	  
      <th scope="col">View</th>	 	        
    </tr>		
	@endif
  </thead>
  <tbody>
  @if(Auth::check() && Auth::user()->isApprover())  
    @foreach($url as $l)
    <tr>
      <th scope="row">{{ $loop->iteration}}</th>
      <td>{{ $l->item_type }}</td> 
      <td>
	  @php 
	  $list = preg_split("/[\n]+/", $l->descr);
	  @endphp
	  @foreach($list as $m)
	  {{$m}}<br>
	  @endforeach	  
	  </td>
      <td>{{ $l->created_at }}</td>	  
	  <td scope="row">{{ $l->user->email}}</td>
      <td>{{$crt->creator }}</td>		  
      
      <td>@if($l->approved==1)
	       <b class="text-success">  APPROVED </b>
		@elseif($l->approved==2)
			<b class="text-danger">UNAPPROVED</b>
			@else
			<b class="text-info">	AWAITING APPROVAL </b>
			@endif
		</td> 
      <td><a href="{{ route('req.edit', $l->id) }}"><button class="btn btn-info">Change</button></a></td>	         
    </tr>
    @endforeach
	@else
  @foreach($url as $l)
    <tr>
      <th scope="row">{{ $loop->iteration}}</th>
      <td>{{ $l->item_type }}</td> 
      <td>
	  @php 
	  $list = preg_split("/[\n]+/", $l->descr);
	  @endphp
	  @foreach($list as $m)
	  {{$m}}<br>
	  @endforeach	  
	  </td>
      <td>{{ $l->created_at }}</td>	  
	  <td scope="row">
		@if($l->approved==1)
	       <b class="text-success">  APPROVED </b>
		@elseif($l->approved==2)
			<b class="text-danger">UNAPPROVED</b>
			@else
			<b class="text-info">	AWAITING APPROVAL </b>
			@endif
	  </td> 
      <td><a href="{{ route('req.edit', $l->id) }}"><button class="btn btn-info">Change</button></a></td>	         
    </tr>
    @endforeach		
	
	@endif
  </tbody>
</table> <!-- /table -->
{{ $url->links() }}