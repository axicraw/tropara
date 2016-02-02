@extends ('admin/master')
@section ('content')
	<div class="row page-title">
		<h3>Dashboard - Trolleyin.com</h3>
	</div>

	<div class="row">
		<div class="medium-3 columns ">
			<div class="dash-card">
				<h5 class="text-center">No of Users</h5>
				<h3 class="text-center">{{$users->count()}}</h3>
			</div>
		</div>
		<div class="medium-3 columns">
			<div class="dash-card">
				<h5 class="text-center">No of Categories</h5>
				<h3 class="text-center">{{$categories->count()}}</h3>
			</div>
		</div>
		<div class="medium-3 columns">
			<div class="dash-card">
				<h5 class="text-center">No of Products</h5>
				<h3 class="text-center">{{$products->count()}}</h3>
			</div>
		</div>
		<div class="medium-3 columns">
			<div class="dash-card">
				<h5 class="text-center">No of Areas</h5>
				<h3 class="text-center">{{$areas->count()}}</h3>
			</div>
		</div>
		<div class="medium-3 columns end">
			<div class="dash-card">
				<h5 class="text-center">No of Items Sold</h5>
				<h3 class="text-center">{{$orders->count()}}</h3>
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