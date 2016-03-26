@extends ('admin/master')
@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Products</h3>
		</div>
		<div class="medium-6 columns">
			<ul class="parent-controls">
				<li>
					{!! Form::open(array('route'=>'admin.category.destroy', 'method'=>'delete')); !!}
						<button type="submit" class="button tiny alert link"><i class="fa fa-trash fa-2x"></i></button>
					{!! Form::close(); !!}
				</li>
				<li><a href="admin/product/create"><i class="fa fa-plus-square fa-2x"></i></a></li>
			</ul>
		</div>
	</div>
	<div class="row page-body">
		<div class="medium-12 columns end">
			<input type="text" id="search" placeholder="Search" class="data-table-search" data-search-table="product">
			<table role="grid" width="100%" class="data-table" data-table="product">
				<tr>
					<th width="120"><input type="checkbox" name="select_all" id="select_all"><label for="select_all">All</label></th>
					<th>Name</th>
					<th>Category</th>
					<th width="300">Prices</th>
					<th>MRP</th>
					<th>Brand</th>
					<th>Action</th>
				</tr>
				@forelse($products as $product)
					<tr class="native-records">
						<td><input type="checkbox" name="select_all"></td>
						<td>{{ $product->product_name }}</td>
						<td>
							@foreach($categories as $category)
								@if($category->id === $product->category_id)
									{{ $category->category_name }}
								@endif
							@endforeach
						</td>
						<td>
							@foreach($product->prices as $price)
								<span class="label info">{{ $price->qty }}{{ $price->unit->shortform }} - Rs {{ $price->price }}</span>
							@endforeach
						</td>
						<td><span class="label info">
								@if($product->mrp)
								{{ $product->mrp->qty }}{{ $product->mrp->unit->shortform }} - Rs {{ $product->mrp->mrp }}
								@endif
							</span></td>
						<td>
							@foreach($brands as $brand)
								@if($brand->id === $product->brand_id)
									{{ $brand->brand_name }}
								@endif
							@endforeach
						</td>
						<td>
							<ul class="table-row-controls">
								<li>
									
									<input data-id="{{ $product->id }}" type="submit" class="button tiny delete alert link prodel delalert" value="">
									
								</li>
								<li>
									<a class="primary" href="admin/product/{{ $product->id }}" ><i class="fa fa-pencil-square-o"></i></a>
								</li>
							</ul>
						</td>
					</tr>
				@empty
					<tr><td colspan="5">Add New Products.</td></tr>
				@endforelse
			</table>
			<div class="row">
				<ul class="pagination">
					<li 
						@if($products->currentPage() == 1) 
							class="arrow unavailable" 
						@endif 
					><a href="admin/product/pagin/{{ $products->currentPage() }}/prev">&laquo;</a></li>
					@for ($i=1; $i <= $products->lastPage(); $i++)
						<li 
							@if($products->currentPage() == $i) 
								class="current" 
							@endif
						><a href="admin/product/pagin/{{ $i }}">{{ $i }}</a></li>
					@endfor
					<li 
						@if($products->currentPage() == $products->lastPage()) 
							class="arrow unavailable" 
						@endif 
					><a href="admin/product/pagin/{{ $products->currentPage() }}/next">&raquo;</a></li> 
				</ul>
			</div>
		</div>
	</div>
@stop
@section ('scriptsContent')
<script type="text/javascript" src="js/modals.js"></script>

@stop