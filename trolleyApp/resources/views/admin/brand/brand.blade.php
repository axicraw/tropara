@extends ('admin/master')
@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Brands</h3>
		</div>
		<div class="medium-6 columns">
			<ul class="parent-controls">
				<li>
					{!! Form::open(array('route'=>'admin.brand.destroy', 'method'=>'delete')); !!}
						<button type="submit" class="button tiny alert link"><i class="fa fa-trash fa-2x"></i></button>
					{!! Form::close(); !!}
				</li>
				<li><a href="admin/brand/create"><i class="fa fa-plus-square fa-2x"></i></a></li>
			</ul>
		</div>
	</div>
	<div class="row page-body">
		<div class="medium-6 columns end">
			<input type="text" id="search" placeholder="Search">
			<table role="grid" width="100%">
				<tr>
					<th width="120"><input type="checkbox" name="select_all" id="select_all"><label for="select_all">All</label></th>
					<th>Brand Name</th>
					<th>Action</th>
				</tr>
				@foreach( $brands as $brand )
					<tr>
						<td><input type="checkbox" name="select_all" id="select_all"></td>
						<td>{{ $brand->brand_name }}</td>
						<td>
							<ul class="table-row-controls">
								<li>
									{!! Form::open(array('method'=>'delete', 'route'=>array('admin.brand.destroy', $brand->id))) !!}
										<input type="submit" class="button tiny delete alert link" value="">
									{!! Form::close(); !!}
								</li>
								<li>
									<a class="primary" href="admin/brand/{{ $brand->id }}" ><i class="fa fa-pencil-square-o"></i></a>
								</li>
							</ul>
						</td>
					</tr>
				@endforeach
			</table>

		</div>
	</div>
@stop
@section ('scriptsContent')
<script type="text/javascript" src="js/modals.js"></script>
<script>
		$('a.cate').on('click', function(e){
		e.preventDefault();
	});
</script>

@stop