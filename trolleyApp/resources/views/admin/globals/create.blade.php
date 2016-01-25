@extends ('admin/master')
@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Create New Location</h3>
		</div>
		<div class="medium-6 columns">
			<ul class="parent-controls">
				<li><a href="admin/area" class="danger">Go Back</a></li>
			</ul>
		</div>
	</div>
	<div class="row page-body">
		{!! Form::open(array('route'=>'admin.area.store')) !!}
		<div class="row">
			<div class="medium-6 columns">			
				<label for="area_name">
					Area Name
					<input type="text" id="area_name" name="area_name" required>
				</label>
					
			</div>
		</div>
		<div class="row">
			<div class="medium-6 columns">			
				<input type="checkbox" id="deli" name="deliverable" value="1"><label for="deli">Deliverable</label>
			</div>
		</div>

		<div class="medium-12 columns">
			<div class="row">
				<div class="medium-3 columns">
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
				<div class="medium-3 end columns">
					<p class="text-right">
						<input type="submit" class="button tiny success" value="Create">
					</p>
				</div>
			</div>
		</div>

		{!! Form::close(); !!}
	</div>

@stop
@section ('scriptsContent')

@stop