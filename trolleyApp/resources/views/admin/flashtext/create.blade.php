@extends ('admin/master')
@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Create New Flashtext</h3>
		</div>
		<div class="medium-6 columns">
			<ul class="parent-controls">
				<li><a href="admin/flashtext" class="danger">Go Back</a></li>
			</ul>
		</div>
	</div>
	<div class="row page-body">
		{!! Form::open(array('route'=>'admin.flashtext.store', 'files'=>true)) !!}
		<div class="row">
			<div class="medium-6 columns">			
				<label for="text">
					Text
				</label>
					<textarea id="texty" name="text" required></textarea>
			</div>
		</div>
		<div class="row">
			<div class="medium-6 columns">			
				<input type="checkbox" id="active" name="active" value="1"><label for="active">Active</label>
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