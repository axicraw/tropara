@extends ('admin/master')
@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Category</h3>
		</div>
		<div class="medium-6 columns">
			<ul class="parent-controls">
				<li>
					{!! Form::open(array('route'=>'admin.category.destroy', 'method'=>'delete')); !!}
						<button type="submit" class="button tiny alert link"><i class="fa fa-trash fa-2x"></i></button>
					{!! Form::close(); !!}
				</li>
				<li><a href="admin/category/create"><i class="fa fa-plus-square fa-2x"></i></a></li>
			</ul>
		</div>
	</div>
	<div class="row page-body">
		<div class="medium-6 columns end">
		
			@if($categories->count() < 1)
				<p>No Categories Found!</p>
			@endif
			<ul class="mtree bubba">
				@each('admin.partials.category-tree', $categories, 'category')
			</ul>

		</div>
	</div>
@stop
@section ('scriptsContent')
<script type="text/javascript" src="js/mtree.js"></script>
<script type="text/javascript" src="js/modals.js"></script>
<script>
		$('a.cate').on('click', function(e){
		e.preventDefault();
	});
</script>

@stop