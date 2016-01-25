@extends ('admin/master')
@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Location</h3>
		</div>
		<div class="medium-6 columns">
			<ul class="parent-controls">
				<li><a href="admin/area/create"><i class="fa fa-plus-square fa-2x"></i></a></li>
			</ul>
		</div>
	</div>
	<div class="row page-body">
		<div class="medium-6 columns end">
			<table role="grid" width="100%">
				<tr>
					
					<th>Area Name</th>
					<th>Delivery Cost</th>
					<th>Deliverable</th>
					<th>Action</th>
				</tr>
				@foreach( $areas as $area )
					<tr>
						
						<td>{{ $area->area_name }}</td>
						<td>{{ $area->delivery_cost }}</td>
						<td>
							@if($area->deliverable > 0)
								Yes
							@else
								No
							@endif
						</td>
						<td>
							<ul class="table-row-controls">
								<li>
									{!! Form::open(array('method'=>'delete', 'route'=>array('admin.area.destroy', $area->id))) !!}
										<input type="submit" class="button tiny delete alert link" value="">
									{!! Form::close(); !!}
								</li>
								<li>
									<a class="primary" href="admin/area/{{ $area->id }}" ><i class="fa fa-pencil-square-o"></i></a>
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