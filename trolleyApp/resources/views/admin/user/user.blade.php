@extends ('admin/master')
@section ('content')
	
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Users</h3>
		</div>
		<div class="medium-6 columns">
			<ul class="parent-controls">
				<li>
					
				</li>
			</ul>
		</div>
	</div>
	<div class="row page-body">
		<div class="medium-12 columns end">
			<div class="tabs" data-tab>
				<li class="tab-title active"><a href="#cust">Customers</a></li>
				<li class="tab-title"><a href="#staff">Staffs</a></li>
				<li class="tab-title"><a href="#admin">Admin</a></li>
			</div>
			<div class="tabs-content">
				<div class="content active" id="cust">
					<input type="text" id="search" placeholder="Search" class="data-table-search" data-search-table="product">
					<table role="grid" width="100%" class="data-table" data-table="product">
						<tr>
							<th>Name</th>
							<th>email</th>
							<th>mobile</th>
							<th>address</th>
							<th>active</th>
							<th>COD</th>
							<th>Action</th>
						</tr>
						@forelse($customers as $user)
							<tr class="native-records">
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->mobile }}</td>
								<td>{{ $user->address }}</td>
								<td>{{ $user->active }}</td>
								<td>
									<ul class="table-row-controls">
										@if($user->cod == 1)
											<a href="admin/user/allowcod/{{ $user->id }}" class="button alert micro tight">Block</a>
										@elseif( $user->cod == 0)
											<a href="admin/user/blockcod/{{ $user->id }}" class="button success micro tight">Allow</a>
										@endif
									</ul>
								</td>
								<td>
									<ul class="table-row-controls">
										@if($user->active == 1)
											<a href="admin/user/suspend/{{ $user->id }}" class="button alert micro tight">Suspend</a>
										@elseif( $user->active == 0)
											<a href="admin/user/activate/{{ $user->id }}" class="button success micro tight">Activate</a>
										@endif
									</ul>
								</td>
							</tr>
						@empty
							<tr><td colspan="5">No Cusomers found!</td></tr>
						@endforelse
					</table>
				</div>
				<div class="content" id="staff">
					<table role="grid" width="100%" class="data-table" data-table="product">
						<tr>
							<th>Name</th>
							<th>email</th>
							<th>mobile</th>
							<th>address</th>
							<th>Action</th>
						</tr>
						@forelse($staffs as $user)
							<tr class="native-records">
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->mobile }}</td>
								<td>{{ $user->address }}</td>
								<td>
									<ul class="table-row-controls">
										<li>
										@if($user->active == 1)
											<a href="admin/user/suspend/{{ $user->id }}" class="button alert micro tight">Suspend</a>
										@elseif( $user->active == 0)
											<a href="admin/user/activate/{{ $user->id }}" class="button success micro tight">Activate</a>
										@endif
										</li>
										<li>
											<a class="primary" href="admin/user/staff/{{ $user->id }}" ><i class="fa fa-pencil-square-o"></i></a>
										</li>
									</ul>
								</td>
							</tr>
						@empty
							<tr><td colspan="5">No staffs found!</td></tr>
						@endforelse
					</table>
					<div class="row">
						<div class="medium-12 columns">
							<a href="admin/user/staff/add" class="button tiny"><i class="fa fa-plus"></i> Add staff</a>
						</div>
					</div>
				</div>
				<div class="content" id="admin">
					<table role="grid" width="100%" class="data-table" data-table="product">
						<tr>
							<th>Name</th>
							<th>email</th>
							<th>mobile</th>
							<th>address</th>
							<th>active</th>
							<th>COD</th>
							<th>Action</th>
						</tr>
						@forelse($admins as $user)
							<tr class="native-records">
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->mobile }}</td>
								<td>{{ $user->address }}</td>
								<td>{{ $user->active }}</td>
								<td>
									<ul class="table-row-controls">
										@if($user->cod == 1)
											<a href="admin/user/allowcod/{{ $user->id }}" class="button alert micro tight">Block</a>
										@elseif( $user->cod == 0)
											<a href="admin/user/blockcod/{{ $user->id }}" class="button success micro tight">Allow</a>
										@endif
									</ul>
								</td>
								<td>
									<ul class="table-row-controls">
										@if($user->active == 1)
											<a href="admin/user/suspend/{{ $user->id }}" class="button alert micro tight">Suspend</a>
										@elseif( $user->active == 0)
											<a href="admin/user/activate/{{ $user->id }}" class="button success micro tight">Activate</a>
										@endif
									</ul>
								</td>
							</tr>
						@empty
							<tr><td colspan="5">No admins found!</td></tr>
						@endforelse
					</table>
					<div class="row">
						<div class="medium-12 columns">
							<a href="admin/user/admin/add" class="button tiny"><i class="fa fa-plus"></i> Add Admin</a>
						</div>
					</div>
				</div>
			</div>
			
			
		</div>
	</div>
@stop
@section ('scriptsContent')
@stop