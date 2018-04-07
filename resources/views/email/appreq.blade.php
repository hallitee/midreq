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

<h3>NEW MID CODE CREATION</h3>
<p>
New MID creation request has been approved, please check MID monitor for duplication before 
creating MID. 
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
<tr><td>Requested By</td><td>{{ $req->user->name }}</td></tr>
<tr><td>Requestor Email</td><td>{{ $req->user->email }}</td></tr>
<tr><td>Company </td><td>{{ $req->user->company }}</td></tr>
<tr><td colspan='2' style="text-align:center"><b>     MID CREATOR </b></td></tr>
<tr><td>Email </td><td>{{ $conf->creator }}</td></tr>
<tr><td colspan='2' style="text-align:center"><b>     APPROVER</b></td></tr>
<tr><td>Name </td><td>{{ $user->name }}</td></tr>
<tr><td>Email </td><td>{{ $user->email }}</td></tr>
</tbody >
</table>
<p>To approve now click links below </p>

<br>
<br>
<p>
Thank You, 
</p>
<p>
{{ $user->name }}
</p>
</body>
</html>