
<table class="table table-responsive table-dark table-bordered">
  <thead>
    <tr>
	<th scope="col">S/N</th>
      <th scope="col">User Name</th>
      <th scope="col">User Email</th>    
	  <th scope="col">Family</th>
       <th scope="col">Company</th>
      <th scope="col">Approver</th>   	  
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>      
    </tr>
  </thead>
  <tbody>
    @foreach($url as $l)
    <tr>
      <th scope="row">{{ $l->id}}</th>
      <td>{{ $l->name}}</td> 
	   <td>{{ $l->email}}</td> 
	    <td>{{ $l->U_IT_FAM}}</td> 
      <td>{{ $l->company}}</td> 
	   <td>@if($l->approver == 1)
			YES
		@else
			NO
		@endif
	   </td> 
      <td><a href="{{ route('user.edit', $l->id) }}"><u>Edit</u></a></td>
      <td>
        {!! Form::open(['action' => array('userController@destroy', $l->id),'method'=>'DELETE']) !!}
        <button type="submit"><u>Delete</u></a>
       {!! Form::close() !!}
      </td>         
    </tr>
    @endforeach
  </tbody>
</table> <!-- /table -->
{{ $url->links() }}