@extends('admin.header')
@section('css')
<style>
	.btn-default.btn-on.active{background-color: #5BB75B;color: white;}
	.btn-default.btn-off.active{background-color: #DA4F49;color: white;}
	#status > .active{pointer-events: none;}
</style>
@endsection
@section('content')
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="{{ route('users.index') }}" class="btn btn-success">Users</a></li>
		<li><a href="{{ route('permissions.index') }}" class="btn btn-success">Permissions</a></li>
		<li><a href="{{ URL::to('admin/roles/create') }}" class="btn btn-success">Add Role</a></li>

		{{-- <a href="{{ route('users.index') }}" class="btn btn-default pull-right">Users</a> --}}
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">Roles <small></small></h1>
	<div class="row">
		<div class="col-md-12">
			<table  class="table table-striped table-bordered data-table">
				<thead>
					<tr>
						<th>Role</th>
						<th>Permissions</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($roles as $role)
					<tr>
						<td>{{$role->name}}</td>
						<td>{{ str_replace(array('[',']','"'),' ', $role->permissions()->pluck('name')) }}</td>
						<td>
							<a href="{{ URL::to('admin/roles/'.$role->id.'/edit') }}" class="btn btn-info">Edit</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
@section('js')
<script>

$(document).ready(function(){
	var success = "{{Session::has('success')}}";
	var msg = "{{Session::get('success')}}";
	if (success) {
		$.gritter.add({
			title: "Successfully Created!",
			text: msg,
			time: 3000,
			class_name: "my-sticky-class"
		});
	}
});

</script>
@endsection
