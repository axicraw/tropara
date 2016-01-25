@extends ('admin/master')
@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Edit Category</h3>
		</div>
		<div class="medium-6 columns">
			<ul class="parent-controls">
				<li><a href="admin/category" class="danger">Go Back</a></li>
			</ul>
		</div>
	</div>
	<div class="row page-body">
		{!! Form::open(array('method'=>'put', 'route'=>array('admin.category.update', $currCategory->id))) !!}
		<div class="medium-6 columns">			
			<label for="category_name">
				Category Name
				<input type="text" id="category_name" name="category_name" value="{{ $currCategory['category_name'] }}">
			</label>
		</div>
		<div class="medium-6 columns">			
			<label for="parent_id">
				Parent
			</label>
			<select id="cateParent" name="parent_id">
					<option value="">- None -</option>
				@foreach ($categories as $category)
					<option value="{{ $category->id }}"	
					@if($currCategory['parent_id'] == $category->id)
						selected="selected"
					@endif
					>{{$category->category_name}} </option>
				@endforeach
			</select>
		</div>
		<div class="medium-6 columns">
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
		<div class="medium-6 columns">
			<p class="text-right">
				<input type="submit" class="button tiny primary" value="Update">
			</p>
		</div>

		{!! Form::close(); !!}
	</div>

@stop
@section ('scriptsContent')

@stop