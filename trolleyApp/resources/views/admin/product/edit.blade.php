@extends ('admin/master')
@section ('cssContent')
	<link rel="stylesheet" href="css/dropzone.css">
	<script>const PROD_ID = {{ $product->id }}</script>
@stop
@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Edit Product </h3>
		</div>
		<div class="medium-6 columns">
			<ul class="parent-controls">
				<li><a href="admin/product" class="danger">Go Back</a></li>
			</ul>
		</div>
	</div>
	<div class="row page-body">

		{!! Form::open(array('method'=>'put', 'files'=>true, 'route'=>array('admin.product.update', $product->id))) !!}
		<div class="medium-12 end columns">			
			<div class="row">
				<div class="medium-2 columns">
					<label for="product_name" class="right inline">Product Name</label>
				</div>
				<div class="medium-5 end columns">
					<input type="text" name="product_name" id="product_name" value="{{ $product->product_name }}">
				</div>
			</div>
			<div class="row">
				<div class="medium-2 columns">
					<label for="local_name" class="right inline">Local Name</label>
				</div>
				<div class="medium-5 end columns">
					<input type="text" name="local_name" id="local_name" value="{{ $product->local_name }}">
				</div>
			</div>		
			<div class="row">
				<div class="medium-2 columns">
					<label for="category_id" class="right inline">Category</label>
				</div>
				<div class="medium-5 end columns">
					<select name="category_id" id="category_id">
						@foreach ($categories as $category)
							<option value="{{ $category->id }}"	
							@if($category->id == $product->category_id)
								selected="selected"
							@endif
							>{{$category->category_name}} </option>
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
						<option value="0">None</option>
						@foreach ($brands as $brand)
							<option value="{{ $brand->id }}"	
							@if($brand->id == $product->brand_id)
								selected="selected"
							@endif
							>{{$brand->brand_name}} </option>
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
				<div class="medium-2 columns">
					<label for="quantity" class="right inline">Quantities & Price</label>
				</div>
				<div class="medium-10 end columns">
					<div class="row">
						<div class="quan-prices"  id="quan-prices">
							<div class="medium-2 end columns">
								<div class="quan-price new" data-product="{{ $product->id }}" >
									<div class="row">
										<div class="medium-6 columns">
											<input type="text" class="quantity" placeholder="Quantity">
										</div>
										<div class="medium-6 columns">
											<select class="quan-unit">
												@foreach ($units as $unit)
													<option value="{{ $unit->id }}">{{ $unit->shortform }}</option>
												@endforeach
												
											</select>
										</div>
									</div>
									<div class="row collapse">
										<div class="medium-3 columns">
											<span class="prefix">Rs.</span>
										</div>
										<div class="medium-9 columns">
											<input type="text" class="price">
										</div>
									</div>
									<div class="row">
										<ul class="action-icons">
											<li><a href="#" class="primary save-quan-price" ><i class="fa fa-plus-circle"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<!-- <a href="3" class="button link-anchor tiny" id="empty-quan-price">Add Another</a> -->
					</div>
				</div>
			</div>							
			<div class="row">
				<div class="medium-2 columns">
					<label for="quantity" class="right inline">MRP</label>
				</div>
				
				<div class="medium-10 end columns">
					<div class="row">
						<div class="quan-mrps"  id="quan-mrps">
							<div class="medium-2 end columns">
								<div class="quan-mrp new" data-product="{{ $product->id }}" >
									<div class="row">
										<div class="medium-6 columns">
											<input type="text" class="quantity" placeholder="Quantity">
										</div>
										<div class="medium-6 columns">
											<select class="quan-unit">
												@foreach ($units as $unit)
													<option value="{{ $unit->id }}">{{ $unit->shortform }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="row collapse">
										<div class="medium-3 columns">
											<span class="prefix">Rs.</span>
										</div>
										<div class="medium-9 columns">
											<input type="text" class="mrp">
										</div>
									</div>
									<div class="row">
										<ul class="action-icons">
											<li><a href="#" class="primary save-quan-mrp" ><i class="fa fa-plus-circle"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<!-- <a href="3" class="button link-anchor tiny" id="empty-quan-price">Add Another</a> -->
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="medium-2 columns">
					<label for="desc" class="right inline">Stock/Active</label>
				</div>
				<div class="medium-6 end columns">
					<input type="checkbox" id="ofs" name="out_of_stock" value="1" 
						@if($product->out_of_stock)
							checked="checked"
						@endif
					><label for="ofs">Out Of Stock</label>
					<input type="checkbox" id="active" name="active" value="1"
						@if($product->active)
							checked="checked"
						@endif
					><label for="active">Active</label>
				</div>
			</div>				
			<div class="row">
				<div class="medium-2 columns">
					<label for="desc" class="right inline">Description</label>
				</div>
				<div class="medium-5 end columns">
					<textarea name="description" id="desc">{{ $product->description->description or " "}}</textarea>
				</div>
			</div>					
			<div class="row">
				<div class="medium-2 columns">
					<label for="image1" class="right inline">Images</label>
				</div>
				<div class="medium-10 columns thumb-inputs-wrapper" id="thumb-inputs-wrapper" >
					<div class="row">
						@foreach ($product->images as $image)
							<div class="medium-2 end columns">
								<div class="file-inp-container">
									<input type="file" name="prod_image[]" class="thumb-input" data-fresh="old" data-prod-id="{{ $product->id }}" data-image-id="{{ $image->id }}">
									<img src="images/products/{{ $image->image_name }}" alt="">
									<button class="button tiny alert remove-thumb-input" data-prod-id="{{ $product->id }}" data-image-id="{{ $image->id }}"><i class="fa fa-close"></i></button>
								</div>
							</div>
						@endforeach
						<div class="medium-2 end columns">
							<div class="file-inp-container">
								<input type="file" name="prod_image[]" class="thumb-input" data-fresh="new">
								<img src="" alt="">
							</div>
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
						<input type="submit" class="button tiny" value="Update">
					</p>
				</div>
			</div>
		</div>
		
		{!! Form::close(); !!}
	</div>
	<script id="quant-price-tmpl" type="text/x-jsrender">
		{%for #data%}
		<div class="medium-2 columns">
			<div class="quan-price old" data-product="{{ $product->id }}" >
				<div class="row">
					<div class="medium-6 columns">
						<input type="text" class="quantity" placeholder="Quantity" value={%>qty%}>
					</div>
					<div class="medium-6 columns">
						<select class="quan-unit">
							@foreach ($units as $unit)
								<option {%if unit_id == {{$unit->id}}%} selected="selected" {%/if%} value="{{ $unit->id }}">{{ $unit->shortform }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="row collapse">
					<div class="medium-3 columns">
						<span class="prefix">Rs.</span>
					</div>
					<div class="medium-9 columns">
						<input type="text" class="price" value="{%>price%}">
					</div>
				</div>
				<div class="row">
					<ul class="action-icons">
						<li><a href="#" class="success save-quan-price" data-id="{%>id %}"><i class="fa fa-check-circle"></i></a></li>
						<li><a href="#" class="danger del-quan-price" data-id="{%>id %}"><i class="fa fa-times-circle"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
		{%/for%}
	</script>
	<script id="quant-mrp-tmpl" type="text/x-jsrender">
		{%for #data%}
		<div class="medium-2 columns">
			<div class="quan-mrp old" data-product="{{ $product->id }}" >
				<div class="row">
					<div class="medium-6 columns">
						<input type="text" class="quantity" placeholder="Quantity" value={%>qty%}>
					</div>
					<div class="medium-6 columns">
						<select class="quan-unit">
							@foreach ($units as $unit)
								<option {%if unit_id == {{$unit->id}}%} selected="selected" {%/if%} value="{{ $unit->id }}">{{ $unit->shortform }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="row collapse">
					<div class="medium-3 columns">
						<span class="prefix">Rs.</span>
					</div>
					<div class="medium-9 columns">
						<input type="text" class="mrp" value="{%>mrp%}">
					</div>
				</div>
				<div class="row">
					<ul class="action-icons">
						<li><a href="#" class="success save-quan-mrp" data-id="{%>id %}"><i class="fa fa-check-circle"></i></a></li>
						<li><a href="#" class="danger del-quan-mrp" data-id="{%>id %}"><i class="fa fa-times-circle"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
		{%/for%}
	</script>
@stop
@section ('scriptsContent')
	<script type="text/javascript" src="js/admin/products.js"></script>
@stop