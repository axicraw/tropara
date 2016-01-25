@extends ('admin/master')


@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Edit Admin</h3>
		</div>
		<div class="medium-6 columns">
			<ul class="parent-controls">
				<li><a href="admin/user" class="danger">Go Back</a></li>
			</ul>
		</div>
	</div>
	<div class="row page-body">
		{!! Form::open(array('method'=>'put', 'route'=>array('admin.updateadmin', $admin->id))) !!}
		<div class="medium-12 end columns">			
			<div class="row">
				<div class="medium-2 columns">
					<label for="name" class="right inline">Admin Name</label>
				</div>
				<div class="medium-5 end columns">
					<input type="text" name="name" id="name" value="{{$admin->name}}">
				</div>
			</div>	
			<div class="row">
				<div class="medium-2 columns">
					<label for="email" class="right inline">Admin Email</label>
				</div>
				<div class="medium-5 end columns">
					<input type="text" name="email" id="email" value="{{$admin->email}}" >
				</div>
			</div>			
			<div class="row">
				<div class="medium-5 columns">
					&nbsp;
					@if (count($errors) > 0)
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li class="danger">{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif
				</div>
				<div class="medium-2 end columns">
					<p class="text-right">
						<input type="submit" class="button tiny" value="Update Staff">
					</p>
				</div>
			</div>			
		</div>
		
		{!! Form::close() !!}
	</div>
	
@stop
@section ('scriptsContent')
	<script type="text/javascript" src="js/trolley-forms.js"></script>

@stop