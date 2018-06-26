@extends('admin.header')

@section('content')
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="{{asset('admin/roles')}}" class="btn btn-warning">Back</a></li>

	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">Roles <small>@if(empty($roles->id)) Create @else Edit @endif Page</small></h1>
	<div class="row">
		<div class="col-md-12 well">
			<br>
			<div class="row">
				<div class="col-md-8">
					@if(empty($roles->id))
						 <form class="form-horizontal" role="form" action="{{url('admin/roles')}}" method="POST" id="">
					@else
						<form class="form-horizontal" role="form" action="{{url('admin/roles/'.$roles->id)}}" method="POST" >
						<input type="hidden" name="_method" value="PATCH">
					@endif
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="name" class="col-md-4 control-label">Name</label>

							<div class="col-md-6">
								<input id="name" type="text" class="form-control" name="name" value="{{old('name', $roles->name)}}" autofocus>

								@if ($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('permissions') ? ' has-error' : '' }}">
							<label for="permissions" class="col-md-4 control-label">Permissions</label>

							<div class="col-md-6">



								@foreach ($permissions as $permission)
									<div class="checkbox"><label>
										<input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
										{{ in_array($permission->id, old('permissions', $roles->permissions->pluck('id')->toArray() )) ? ' checked' : '' }} />
										{{ ucfirst($permission->name) }}
									</label></div>
									{{-- {{ Form::checkbox('permissions[]',  $permission->id ) }}
									{{ Form::label($permission->name, ucfirst($permission->name)) }}<br> --}}
								@endforeach

								@if ($errors->has('permissions'))
								<span class="help-block">
									<strong>{{ $errors->first('permissions') }}</strong>
								</span>
								@endif
							</div>
						</div>


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
