@extends ('admin/master')
@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Order No - {{$checkout->id}}</h3>
			<h5>Customer : {{$checkout->user->id}} / {{$checkout->user->name}}</h5>
			<p>
				Address:<br>
				{{$checkout->address}} <br>
				{{$area->area_name}}

			</p>
		</div>
		<div class="medium-6 columns">
			
		</div>
	</div>
	<div class="row page-body">
		<div class="medium-8 columns end">
			<!-- <input type="text" id="search" placeholder="Search"> -->
			<table role="grid" width="100%">
				<tr>
					<th>Product Name</th>
					<th>Local Name</th>
					<th>Quantity</th>
					<th>Nos</th>
				</tr>
				@foreach($checkout->orders as $order)
					<tr>
						<td>{{$order->product['product_name']}}</td>
						<td>{{$order->product['local_name']}}</td>
						<td>{{$order->pqty}}</td>
						<td>{{$order->nos}}</td>
					</tr>
				@endforeach
			</table>
			<p class="text-right">
				Total (including shipping) : <i class="fa fa-ruppee"></i>{{$checkout->total}}
			</p>

		</div>
		<div class="medium-8 end columns">
			<p class="text-right">
				<a href="admin/order/print/{{$checkout->id}}" target="_blank" class="button tiny">Print</a>
			</p>
		</div>
	</div>
	
@stop
@section ('scriptsContent')
<script type="text/javascript" src="js/modals.js"></script>
<script>
	
</script>

@stop