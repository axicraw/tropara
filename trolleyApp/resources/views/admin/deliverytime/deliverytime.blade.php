@extends ('admin/master')
@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Delivery Times</h3>
		</div>
		<div class="medium-6 columns">
			<ul class="parent-controls">
				<li><a href="admin/delivery/create"><i class="fa fa-plus-square fa-2x"></i></a></li>
			</ul>
		</div>
	</div>
	<div class="row page-body">
		<div class="medium-6 columns end">
			<table role="grid" width="100%">
				<tr>
					
					<th>Name</th>
					<th>Start</th>
					<th>Stop</th>
					<th>Active</th>
					<th>Action</th>
				</tr>
				@foreach( $dts as $dt )
					<tr>
						
						<td>{{ $dt->name }}</td>
						<td>{{ $dt->start }}</td>
						<td>{{ $dt->stop }}</td>
						<td>
							@if($dt->active > 0)
								Yes
							@else
								No
							@endif
						</td>
						<td>
							<ul class="table-row-controls">
								<li>
									{!! Form::open(array('method'=>'delete', 'route'=>array('admin.delivery.destroy', $dt->id))) !!}
										<input type="submit" class="button tiny delete alert link" value="">
									{!! Form::close(); !!}
								</li>
								<li>
									<a class="primary" href="admin/delivery/{{ $dt->id }}" ><i class="fa fa-pencil-square-o"></i></a>
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