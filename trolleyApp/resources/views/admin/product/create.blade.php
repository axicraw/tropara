@extends ('admin/master')


@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Create New Product</h3>
		</div>
		<div class="medium-6 columns">
			<ul class="parent-controls">
				<li><a href="admin/product" class="danger">Go Back</a></li>
			</ul>
		</div>
	</div>
	<div class="row page-body">
		{!! Form::open(array('route'=>'admin.product.store', 'files'=>true)) !!}
		<div class="medium-12 end columns">			
			<div class="row">
				<div class="medium-2 columns">
					<label for="product_name" class="right inline">Product Name</label>
				</div>
				<div class="medium-5 end columns">
					<input type="text" name="product_name" id="product_name" >
				</div>
			</div>			
			<div class="row">
				<div class="medium-2 columns">
					<label for="local_name" class="right inline">Local Name</label>
				</div>
				<div class="medium-5 end columns">
					<input type="text" name="local_name" id="local_name" >
				</div>
			</div>		
			<div class="row">
				<div class="medium-2 columns">
					<label for="category_id" class="right inline">Category</label>
				</div>
				<div class="medium-5 end columns">
					<select name="category_id" id="category_id">
						@foreach($categories as $category)
							<option value="{{ $category['id'] }}">{{ $category['category_name'] }}</option>
						@endforeach
					</select>
				</div>
				<div class="medium-5 columns">
					<div class="row collapse">
						<div class="medium-2 columns">
							<span class="prefix">New</span>
						</div>
						<div class="medium-7 columns">
							<!-- form -->
							<input type="text" name="" placeholder="Category Name" id="newcategory" data-name="category_name">
						</div>
						<div class="medium-3 columns">
							<a href="#" class="button postfix link-anchor" data-id="newcategory" data-url="admin/category/add" data-method="post" >Add</a>
						</div>
					</div>
				</div>				
			</div>			
			<div class="row">
				<div class="medium-2 columns">
					<label for="brand_id" class="right inline">Brand</label>
				</div>
				<div class="medium-5 end columns">
					<select name="brand_id" id="brand_id">
						@foreach($brands as $brand)
							<option value="{{ $brand['id'] }}">{{ $brand['brand_name'] }}</option>
						@endforeach
					</select>
				</div>
				<div class="medium-5 columns">
					<div class="row collapse">
						<div class="medium-2 columns">
							<span class="prefix">New</span>
						</div>
						<div class="medium-7 columns">
							<!-- form -->
							<input type="text" placeholder="Brand Name" id="newbrand" data-name="brand_name">
						</div>
						<div class="medium-3 columns">
							<a href="#" class="button postfix link-anchor" data-id="newbrand" data-url="admin/brand/add" data-method="post">Add</a>
						</div>
					</div>
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
						<input type="submit" class="button tiny" value="Create Product">
					</p>
				</div>
			</div>			
		</div>
		
		{!! Form::close(); !!}
	</div>
	
@stop
@section ('scriptsContent')

@stop