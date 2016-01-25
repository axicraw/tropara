@extends ('admin/master')
@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Edit Brand</h3>
		</div>
		<div class="medium-6 columns">
			<ul class="parent-controls">
				<li><a href="admin/brand" class="danger">Go Back</a></li>
			</ul>
		</div>
	</div>
	<div class="row page-body">
		{!! Form::open(array('method'=>'put', 'route'=>array('admin.brand.update', $brand['id']))) !!}
		<div class="medium-6 columns">			
			<label for="brand_name">
				Brand Name
				<input type="text" id="brand_name" name="brand_name" value="{{ $brand->brand_name }}">
			</label>
		</div>
		<div class="medium-12 columns">
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
					<input type="submit" class="button tiny primary" value="Update">
				</p>
			</div>
		</div>

		{!! Form::close() !!}
	</div>

@stop
@section ('scriptsContent')

@stop