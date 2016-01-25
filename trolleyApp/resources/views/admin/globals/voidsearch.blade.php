@extends ('admin/master')
@section ('content')
	<div class="row page-title">
		<div class="medium-6 end columns">
			<h3 class="title">Void Searches</h3>
		</div>
	</div>
	<div class="row page-body">
		<div class="medium-12 columns">
			<div class="row">
				<div class="medium-6 columns end">
					<table role="grid" width="100%">
						<tr>
							
							<th>Search keyword</th>
							<th>User Mobile</th>
							<th>User Area</th>
						</tr>
						@foreach( $searches as $search )
							<tr>
								
								<td>{{$search->keyword}}</td>
								<td>
									@if($search->user->mobile)
										{{$search->user->mobile}}
									@else
										Anonymous
									@endif
								</td>
								<td>{{$search->user->area['area_name']}}</td>
							</tr>
						@endforeach
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