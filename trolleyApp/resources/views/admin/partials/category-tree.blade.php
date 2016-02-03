<li>
	<a href="" class="">
		<div class="row">
			<div class="medium-10 columns">
				{{ $category['category_name'] }}
			</div>
			<div class="medium-2 columns">
				<div class="text-right tree-controls">
					
					{!! Form::open(array('method'=>'delete', 'route'=>array('admin.category.destroy', $category['id']))) !!}
						<input type="submit" class="button link delete alert link delalert" value=" ">
					<!-- <button class="button link alert" data-src="{{ route('admin.category.destroy', $category['id']) }}" data-method="delete"><i class="fa fa-trash danger"></i></button> -->
					{!! Form::close(); !!}
					<button class="button link primary" data-src="admin/category/{{ $category['id'] }}" ><i class="fa fa-pencil-square-o"></i></button>
				</div>
			</div>
		</div>
	</a>
	@if (count($category['children']) > 0)
	    <ul>
	    @foreach($category['children'] as $category)
	        @include('admin.partials.category-tree', $category)
	    @endforeach
	    </ul>
	@endif
</li>

