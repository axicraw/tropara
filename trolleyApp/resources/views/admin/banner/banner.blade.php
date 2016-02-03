@extends ('admin/master')
@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Banners</h3>
		</div>
		<div class="medium-6 columns">
			<ul class="parent-controls">
				<li><a href="admin/banner/create"><i class="fa fa-plus-square fa-2x"></i></a></li>
			</ul>
		</div>
	</div>
	<div class="row page-body">
		<div class="medium-6 columns end">
			<table role="grid" width="100%">
				<tr>
					
					<th>Title</th>
					<th>Caption</th>
					<th>image</th>
					<th>location</th>
					<th>action</th>
				</tr>
				@foreach( $banners as $banner )
					<tr>
						
						<td>{{ $banner->title }}</td>
						<td>{{ $banner->caption }}</td>
						<td><img src="images/banners/{{$banner->image['image_name']}}" alt="" width="50"></td>
						<td>{{ $banner->location_id }}</td>
						<td>
							<ul class="table-row-controls">
								<li>
									{!! Form::open(array('method'=>'delete', 'route'=>array('admin.banner.destroy', $banner->id))) !!}
										<input type="submit" class="button tiny delete alert link delalert" value="">
									{!! Form::close(); !!}
								</li>
								<li>
									<a class="primary" href="admin/banner/{{ $banner->id }}" ><i class="fa fa-pencil-square-o"></i></a>
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