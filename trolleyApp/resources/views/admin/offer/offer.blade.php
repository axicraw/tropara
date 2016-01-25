@extends ('admin/master')
@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Offers</h3>
		</div>
		<div class="medium-6 columns">
			<ul class="parent-controls">
				<li>
					{!! Form::open(array('route'=>'admin.offer.destroy', 'method'=>'delete')); !!}
						<button type="submit" class="button tiny alert link"><i class="fa fa-trash fa-2x"></i></button>
					{!! Form::close(); !!}
				</li>
				<li><a href="admin/offer/create"><i class="fa fa-plus-square fa-2x"></i></a></li>
			</ul>
		</div>
	</div>
	<div class="row page-body">
		<div class="medium-12 columns end">
			<input type="text" id="search" placeholder="Search" class="data-table-search" data-search-table="product">
			<table role="grid" width="100%" class="data-table" data-table="product">
				<tr>
					<th width="120"><input type="checkbox" name="select_all" id="select_all"><label for="select_all">All</label></th>
					<th>Name</th>
					<th>Description</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Offer For</th>
					<th>Discount</th>
					<th>Active</th>
					<th>Action</th>
				</tr>
				@forelse($offers as $offer)
					<tr class="native-records">
						<td><input type="checkbox" name="select_all"></td>
						<td>{{ $offer->offer_name }}</td>
						<td>{{ $offer->description }}</td>
						<td>{{ $offer->start }}</td>
						<td>{{ $offer->end }}</td>
						<td>
							@if($offer->products->count() > 0)
								Products
							@elseif($offer->categories->count() > 0)
								Categories
							@endif
						</td>
						<td>
							{{ $offer->amount }}
							@if( $offer->offer_type == 1 )
								%
							@else
								Rs
							@endif
						</td>
						<td>
							@if( $offer->active )
								Active
							@else
								Inactive
							@endif
						</td>
						<td>
							<ul class="table-row-controls">
								<li>
									{!! Form::open(array('method'=>'delete', 'route'=>array('admin.offer.destroy', $offer->id))) !!}
										<input type="submit" class="button tiny delete alert link" value="">
									{!! Form::close(); !!}
								</li>
								<li>
									<a class="primary" href="admin/offer/{{ $offer->id }}" ><i class="fa fa-pencil-square-o"></i></a>
								</li>
							</ul>
						</td>
					</tr>
				@empty
					<tr><td colspan="5">Add New Offers.</td></tr>
				@endforelse
			</table>
		</div>
	</div>
@stop
@section ('scriptsContent')
<script type="text/javascript" src="js/modals.js"></script>

@stop