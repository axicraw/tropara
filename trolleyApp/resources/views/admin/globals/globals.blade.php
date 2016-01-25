@extends ('admin/master')
@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Global Settings</h3>
		</div>
		<div class="medium-6 columns">
			<ul class="parent-controls">
				<li><a href="admin/area/create"><i class="fa fa-plus-square fa-2x"></i></a></li>
			</ul>
		</div>
	</div>
	<div class="row page-body">
		<div class="medium-12 columns">
			<h5>Delivery Time</h5>
			<div class="row">
				<div class="medium-6 columns end">
					<table role="grid" width="100%">
						<tr>
							
							<th>From </th>
							<th>To</th>
							<th>Action</th>
						</tr>
						@foreach( $areas as $area )
							<tr>
								
								<td><input type="text" name="from"></td>
								<td><input type="text" name="to"></td>
								<td>
									<ul class="table-row-controls">
										<li>
											{!! Form::open(array('method'=>'delete', 'route'=>array('admin.area.destroy', $area->id))) !!}
												<input type="submit" class="button tiny delete alert link" value="">
											{!! Form::close(); !!}
										</li>
										<li>
											<a class="primary" href="admin/area/{{ $area->id }}" ><i class="fa fa-floppy-o"></i></a>
										</li>
									</ul>
								</td>
							</tr>
						@endforeach
						<tr>
							<td><input type="text" name="from"></td>
							<td><input type="text" name="to"></td>
							<td>
								<ul class="table-row-controls">
									<li>
										<a class="primary" href="admin/area/{{ $area->id }}" ><i class="fa fa-floppy-o"></i></a>
									</li>
								</ul>
							</td>
						</tr>
					</table>
				
				</div>
			</div>
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