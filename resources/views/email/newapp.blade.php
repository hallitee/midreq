@php 
$desc = explode("\r\n", $req->descr)
@endphp
<html>
<style>
.table2 {
	border-collapse: collapse;
	}
.table2 th{

	border: 1px solid black
	}
.table2 td{

	border: 1px solid black
	}
</style>
<head></head>
<body style="background: white; color: black">

<h3>NEW MID CODE REQUEST</h3>
<p>
New MID creation request awaiting approval, please check MID monitor for duplication
because once approved MID creator will be notified.
</p>
<table class='table2' style="width:30%">
<thead>
<tr>
<th>Parameter</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr><td>Item Type</td><td>{{ $req->item_type}}</td></tr>
<tr><td rowspan="{{ count($desc)+1}}">Item Description</td></tr>
@foreach($desc as $d)
<tr>
<td> 
{{$d}}
 </td>
 </tr>
@endforeach


<tr><td>Material Type</td><td>{{ $req->mat_type }}  </td></tr>
<tr><td>Brand</td><td>{{ $req->brand }}</td></tr>
<tr><td>Requested By</td><td>{{ $user->name }}</td></tr>
<tr><td>Requestor Email</td><td>{{ $user->email }}</td></tr>
<tr><td>Company </td><td>{{ $user->company }}</td></tr>
<tr><td colspan='2' style="text-align:center"><b>     APPROVER</b></td></tr>
<tr><td>Name </td><td>{{ $conf->name }}</td></tr>
<tr><td>Email </td><td>{{ $conf->email }}</td></tr>
</tbody >
</table>
<br>
<p>To approve/unapprove now click links below </p>
<p>
<table>
<tbody>
<tr>	
<td>
	

        <a href="{{ url('emailApp')."?id=".$req->id."&approval=1&approver=".$user->id."&creator=".$conf->id }}"><button type="submit"><u>APPROVE</u></button></a>
	   </td>
	   <td>

        <a href="{{ url('emailApp')."?id=".$req->id."&approval=2&approver=".$user->id."&creator=".$conf->id }}"><button type="submit"><u>UNAPPROVE</u></button></a>	

	   </td>
	   </tr>
	   </tbody>
</table>
	</p> 
<br>
<p>
Thank You, 
</p>
<p>
{{ $user->name }}
</p>
</body>
</html>