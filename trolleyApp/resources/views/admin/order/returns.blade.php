@extends ('admin/master')
@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Returns</h3>
		</div>
		<div class="medium-6 columns">
			
		</div>
	</div>
	<div class="row page-body">
		<div class="medium-12 columns end">
			<!-- <input type="text" id="search" placeholder="Search"> -->
			<table role="grid" width="100%">
				<tr>
					<th>Return ID</th>
					<th>Customer Name</th>
					<th>Mobile</th>
					<th>Address</th>
					<th>Area</th>
					<th>Items</th>
					<th>Amount</th>
					<th>Status</th>
				</tr>
				@foreach($returns as $ret)
					<tr>
						<td>{{$ret->id}}</td>
						<td>{{$ret->name}}</td>
						<td>{{$ret->mobile}}</td>
						<td>{{$ret->address}}</td>
						<td>{{$ret->area}}</td>
						<td>
							@foreach($ret->order_return as $order_return)
								<span class="label alert">{{$order_return->orders->product->product_name}} - {{$order_return->pqty}} - {{$order_return->nos}}</span>
							@endforeach
						</td>
						<td>
							-
						</td>
						<td>							
							<button href="#" data-dropdown="changeStatus" aria-controls="changeStatus" aria-expanded="false" class="button dropdown tiny">{{$ret->status}}</button><br>
							<ul id="changeStatus" data-dropdown-content class="f-dropdown" aria-hidden="true">
							  <li><a href="admin/order/returns/status/{{$ret->id}}/1">Return Booked</a></li>
							  <li><a href="admin/order/returns/status/{{$ret->id}}/2">Not Reachable</a></li>
							  <li><a href="admin/order/returns/status/{{$ret->id}}/3">Returned</a></li>
							  <li><a href="admin/order/returns/status/{{$ret->id}}/4">Negotiated</a></li>
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
	
</script>

@stop