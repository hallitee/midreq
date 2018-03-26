
<table class="table table-responsive table-dark table-bordered">
  <thead>
    <tr>
      <th scope="col">Code</th>
      <th scope="col">Name</th>    
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>      
    </tr>
  </thead>
  <tbody>
    @foreach($url as $l)
    <tr>
      <th scope="row">{{ $l->id}}</th>
      <td>{{ $l->name }}</td> 
      <td><a href="{{ route('family.edit', $l->id) }}"><u>Edit</u></a></td>
      <td>
        {!! Form::open(['action' => array('FamilyController@destroy', $l->id),'method'=>'DELETE']) !!}
        <button type="submit"><u>Delete</u></a>
       {!! Form::close() !!}
      </td>         
    </tr>
    @endforeach
  </tbody>
</table> <!-- /table -->
{{ $url->links() }}