@extends('admin.header')

@section('content')
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="{{asset('admin/permissions')}}" class="btn btn-warning">Back</a></li>

	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">Permissions <small>@if(empty($permissions->id)) Create @else Edit @endif Page</small></h1>
	<div class="row">
		<div class="col-md-12 well">
			<br>
			<div class="row">
				<div class="col-md-8">
					@if(empty($permissions->id))
						 <form class="form-horizontal" role="form" action="{{url('admin/permissions')}}" method="POST" id="">
					@else
						<form class="form-horizontal" role="form" action="{{url('admin/permissions/'.$permissions->id)}}" method="POST" >
						<input type="hidden" name="_method" value="PATCH">
						{{-- <input type="hidden" name="id" id="id" value="{{$permissions->id}}"> --}}
					@endif
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="name" class="col-md-4 control-label">Name</label>

							<div class="col-md-6">
								<input id="name" type="text" class="form-control" name="name" value="{{old('name', $permissions->name)}}" autofocus>

								@if ($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
								@endif
							</div>
						</div>

						@if(!$roles->isEmpty()) //If no roles exist yet
						<div class="form-group">
							<label for="roles" class="col-md-4 control-label">Assign Permission to Roles</label>

							<div class="col-md-6">
									@foreach ($roles as $role)
										{{-- {{ Form::checkbox('roles[]',  $role->id ) }}
										{{ Form::label($role->name, ucfirst($role->name)) }} --}}
									@endforeach
							</div>
						</div>
					@endif


						<div class="form-group">
						<div class="col-md-6 col-md-offset-4 text-right">
								<button type="submit" class="btn btn-success">
									Create
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
