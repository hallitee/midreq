
<table class="table table-responsive table-dark table-bordered">
  <thead>
    <tr>
	<th scope="col">S/N</th>
      <th scope="col">MID Creator Email</th>
      <th scope="col">Hod Email</th>    
      <th scope="col">Company</th>    	  
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>      
    </tr>
  </thead>
  <tbody>
    @foreach($url as $l)
    <tr>
      <th scope="row">{{ $l->id}}</th>
      <td>{{ $l->creator }}</td> 
	   <td>{{ $l->hod }}</td> 
	    <td>{{ $l->company }}</td> 
      <td><a href="{{ route('config.edit', $l->id) }}"><u>Edit</u></a></td>
      <td>
        {!! Form::open(['action' => array('ConfigController@destroy', $l->id),'method'=>'DELETE']) !!}
        <button type="submit"><u>Delete</u></a>
       {!! Form::close() !!}
      </td>         
    </tr>
    @endforeach
  </tbody>
</table> <!-- /table -->
{{ $url->links() }}