@extends ('admin/master')
@section ('cssContent')
	<link rel="stylesheet" href="css/jquery.timepicker.css">
@stop
@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Create New Delivery Time</h3>
		</div>
		<div class="medium-6 columns">
			<ul class="parent-controls">
				<li><a href="admin/delivery" class="danger">Go Back</a></li>
			</ul>
		</div>
	</div>
	<div class="row page-body">
		{!! Form::open(array('route'=>'admin.delivery.store')) !!}


		<div class="medium-12 columns">
			<div class="row">
				<div class="medium-2 columns">
					<label for="name" class="right inline">Name</label>
				</div>
				<div class="medium-4 end columns">
					<input type="text" name="name" id="name">
				</div>
			</div>
			<div class="row">
				<div class="medium-2 columns">
					<label for="start" class="right inline">Start Time</label>
				</div>
				<div class="medium-2 end columns">
					<input type="text" name="start" id="start">
				</div>
			</div>
			<div class="row">
				<div class="medium-2 columns">
					<label for="stop" class="right inline">Stop Time</label>
				</div>
				<div class="medium-2 end columns">
					<input type="text" name="stop" id="stop">
				</div>
			</div>
			<div class="row">
				<div class="medium-2 columns">
					<label for="active" class="right inline">Active</label>
				</div>
				<div class="medium-2 end columns">
					<input type="checkbox" checked id="active" name="active" value="1">
				</div>
			</div>
			<div class="row">
				<div class="medium-6 end columns">
					<p class="text-right">
						<button type="submit tiny">Save Delivery Time</button>
					</p>
				</div>
			</div>
			<div class="row">
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
		</div>

		{!! Form::close(); !!}
	</div>

@stop
@section ('scriptsContent')
	<script src="js/jquery.timepicker.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			$('#start').timepicker();
			$('#stop').timepicker();
		});
	</script>
@stop