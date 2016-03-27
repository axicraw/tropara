@extends ('admin/master')
@section ('content')
	<div class="row page-title">
		<div class="small-9 columns">
			<h3>Dashboard - Trolleyin.com</h3>
		</div>
		<div class="small-3 end columns">
			<div class="row">
				<div class="medium-6 columns end">
					<label for="salesemail">Maintenance Mode</label>
				</div>
				<div class="switch round">
				  <input id="maintenance" type="checkbox" name="maintenance">
				  <label for="maintenance"></label> 
				</div> 
			</div>
		</div>
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

	$(document).ready(function(){

		$.when(http_get('admin/getMaintenanceMode')).then(function(response){
			if(response == 'on'){
				$('#maintenance').prop( "checked", true );	
			}else{
				$('#maintenance').prop( "checked", false );
			}
		}, function(){
			console.log('Something wrong in getting maintenance status');
		});

	});

	$('#maintenance').on('change', function(){
		var data = {};
		if($(this).is(':checked')) {
			var $this = $(this);
			data['maintenance'] = 'on';
			$.when(http_post('admin/changeMaintenanceMode', data)).then(function(){
				alert('The site is in Maintenance Mode');
			}, function(){
				$this.prop( "checked", false );			
				alert('Something went wrong cannot change mode.');

			});
		}
		else{
			data['maintenance'] = 'off';
			$.when(http_post('admin/changeMaintenanceMode', data)).then(function(){
				alert('The site is in Working Mode');
			}, function(){
				$this.prop( "checked", true );
				alert('Something went wrong cannot change mode.');
			});
		}

	});
</script>

@stop