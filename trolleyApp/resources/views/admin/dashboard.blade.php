@extends ('admin/master')
@section ('content')
	<div class="row page-title">
		<h3>Dashboard - Trolleyin.com</h3>
	</div>

	<div class="row">
		<div class="medium-3 columns ">
			<div class="dash-card">
				<h5 class="text-center">No of Users</h5>
				<h3 class="text-center">50</h3>
			</div>
		</div>
		<div class="medium-3 columns">
			<div class="dash-card">
				<h5 class="text-center">No of Categories</h5>
				<h3 class="text-center">10</h3>
			</div>
		</div>
		<div class="medium-3 columns">
			<div class="dash-card">
				<h5 class="text-center">No of Products</h5>
				<h3 class="text-center">5000</h3>
			</div>
		</div>
		<div class="medium-3 columns">
			<div class="dash-card">
				<h5 class="text-center">No of Areas</h5>
				<h3 class="text-center">20</h3>
			</div>
		</div>
		<!-- <div class="medium-3 columns dash-card">
			<h5 class="text-center">No of Users</h5>
			<h3 class="text-center">50</h3>
		</div>
		<div class="medium-3 columns">
			<h5 class="text-center">No of Categories</h5>
			<h3 class="text-center">10</h3>
		</div>
		<div class="medium-3 columns">
			<h5 class="text-center">No of Products</h5>
			<h3 class="text-center">5000</h3>
		</div>
		<div class="medium-3 columns">
			<h5 class="text-center">No of Areas</h5>
			<h3 class="text-center">20</h3> -->
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