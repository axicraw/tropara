@extends ('admin/master')
@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">FlashText</h3>
		</div>
		<div class="medium-6 columns">
			<ul class="parent-controls">
				<li><a href="admin/flashtext/create"><i class="fa fa-plus-square fa-2x"></i></a></li>
			</ul>
		</div>
	</div>
	<div class="row page-body">
		<div class="medium-6 columns end">
			<table role="grid" width="100%">
				<tr>
					
					<th>Text</th>
					<th>active</th>
					<th>action</th>
				</tr>
				@foreach( $flashtext as $flash )
					<tr>
						
						<td>{{ $flash->text }}</td>
						<td>{{ $flash->active }}</td>
						<td>
							<ul class="table-row-controls">
								<li>
									{!! Form::open(array('method'=>'delete', 'route'=>array('admin.flashtext.destroy', $flash->id))) !!}
										<input type="submit" class="button tiny delete alert link delalert" value="">
									{!! Form::close(); !!}
								</li>
								<li>
									<a class="primary" href="admin/flashtext/{{ $flash->id }}" ><i class="fa fa-pencil-square-o"></i></a>
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