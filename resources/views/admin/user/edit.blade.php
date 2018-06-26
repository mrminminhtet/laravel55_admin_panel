@extends('admin.header')

@section('content')
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="{{asset('admin/user-lists')}}" class="btn btn-warning">Back</a></li>

	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">Users <small>Edit Page</small></h1>
	<div class="row">
		<div class="col-md-12 well">
			<br>
			<div class="row">
				<div class="col-md-8">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/user/'.$user->id.'/edit') }}">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="name" class="col-md-4 control-label">Name</label>

							<div class="col-md-6">
								<input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" autofocus>

								@if ($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label for="email" class="col-md-4 control-label">E-Mail Address</label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">

								@if ($errors->has('email'))
								<span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
							<label for="roles" class="col-md-4 control-label">Roles</label>

							<div class="col-md-6">								
								<div class="checkbox"><label>
										<input id="role" type="checkbox" name="roles[]"
										{{$user->role != null ? 'checked' : ''}}
										/>
										<label for="role">Admin</label>
									</label>
								</div>								

								@if ($errors->has('roles'))
								<span class="help-block">
									<strong>{{ $errors->first('roles') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<label for="password" class="col-md-4 control-label">Password</label>

							<div class="col-md-6">
								<input id="password" type="password" class="form-control" name="password">

								@if ($errors->has('password'))
								<span class="help-block">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
							<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

							<div class="col-md-6">
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation">

								@if ($errors->has('password_confirmation'))
								<span class="help-block">
									<strong>{{ $errors->first('password_confirmation') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group">
						<div class="col-md-6 col-md-offset-4 text-right">
								<a href="{{url('admin/user-lists')}}" class="btn btn-warning">Cancel</a>
								<button type="submit" class="btn btn-success">
									Update
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
@section('js')
<script>
	$(document).ready(function(){
		var success = "{{Session::has('message')}}";
		if (success) {
			$.gritter.add({
                title: "Error",
                text: "Please check confirmation password!",
                time: 3000,
                class_name: "my-sticky-class"
            });
		}
	});
</script>
@endsection
