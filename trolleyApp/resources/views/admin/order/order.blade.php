@extends ('admin/master')
@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Orders</h3>
		</div>
		<div class="medium-6 columns">
			
		</div>
	</div>
	<div class="row page-body">
		<div class="medium-12 columns end">
			<!-- <input type="text" id="search" placeholder="Search"> -->
			<table role="grid" width="100%">
				<tr>
					<th>Checkout ID</th>
					<th>Customer Name</th>
					<th>Address</th>
					<th>Items</th>
					<th>Payment</th>
					<th>Delivery Time</th>
					<th>Status</th>
					<th></th>
				</tr>
				@foreach($checkouts as $checkout)
					<tr>
						<td>{{$checkout->id}}</td>
						<td>{{$checkout->user->name}}</td>
						<td>{{$checkout->address}}</td>
						<td><a href="admin/order/{{$checkout->id}}" class="button tiny">view</a></td>
						<td>
							@if($checkout->payment > 0)
								Received
							@else
								Cash On Delivery
							@endif
						</td>
						<td>{{$checkout->deliverytime}}</td>
						<td>
							{{$checkout->status}}
						</td>
						<td>							
							<button href="#" data-dropdown="changeStatus{{$checkout->id}}" aria-controls="changeStatus" aria-expanded="false" class="button dropdown tiny">Change Status</button><br>
							<ul id="changeStatus{{$checkout->id}}" data-dropdown-content class="f-dropdown" aria-hidden="true">
							  <li><a href="admin/order/changestatus/{{$checkout->id}}/1">Order Placed</a></li>
							  <li><a href="admin/order/changestatus/{{$checkout->id}}/2">Ready to Dispatch</a></li>
							  <li><a href="admin/order/changestatus/{{$checkout->id}}/3">In Transit</a></li>
							  <li><a href="admin/order/changestatus/{{$checkout->id}}/4">Delivered</a></li>
							</ul>
						</td>
					</tr>
				@endforeach
			</table>

		</div>
	</div>
	<div id="itemList" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
	  <h2 id="modalTitle">Item List</h2>
	  <p class="lead">Your couch.  It is mine.</p>
	  <p>I'm a cool paragraph that lives inside of an even cooler modal. Wins!</p>
	  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
	</div>
@stop
@section ('scriptsContent')
<script type="text/javascript" src="js/modals.js"></script>
<script>
	
</script>

@stop