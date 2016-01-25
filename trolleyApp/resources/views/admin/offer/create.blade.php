@extends ('admin/master')
@section ('cssContent')
	<link rel="stylesheet" href="css/jquery-ui/ui-lightness/jquery-ui.min.css">
	<link rel="stylesheet" href="css/select2.min.css">
@stop
@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Create New Offer</h3>
		</div>
		<div class="medium-6 columns">
			<ul class="parent-controls">
				<li><a href="admin/product" class="danger">Go Back</a></li>
			</ul>
		</div>
	</div>
	<div class="row page-body">
		
		<ul class="tabs" data-tab>
			<li class="tab-title active"><a href="#range">Date-range</a></li>
			<li class="tab-title"><a href="#weekly">Weekly</a></li>
			<li class="tab-title"><a href="#monthly">Monthly</a></li>
		</ul>
		<div class="tabs-content create-offer">
			<div class="content active" id="range">
				{!! Form::open(array('route'=>'admin.offer.store', 'files'=>true)) !!}
					<div class="row">
						<div class="medium-2 columns">
							<label for="offerName" class="right inline">Offer Name</label>
						</div>
						<div class="medium-5 end columns">
							<input type="text" name="offer_name" id="offerName">
						</div>
					</div>
					<div class="row">
						<div class="medium-2 columns">
							<label for="desc" class="right inline">Description</label>
						</div>
						<div class="medium-5 end columns">
							<textarea name="description" id="desc" cols="30" rows="3"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="medium-2 columns">
							<label for="start_date" class="right inline">Start Date</label>
						</div>
						<div class="medium-2 end columns">
							<input type="text" name="start_date" id="start_date">
						</div>
					</div>
					<div class="row">
						<div class="medium-2 columns">
							<label for="end_date" class="right inline">End Date</label>
						</div>
						<div class="medium-2 end columns">
							<input type="text" name="end_date" id="end_date">
						</div>
					</div>
					<div class="row">
						<div class="medium-2 columns">
							<label for="" class="right inline">For</label>
						</div>
						<div class="medium-2 end columns">
							<select id="selectFor" name="offerfor">
								<option value="product">Products</option>
								<option value="category" selected>Categories</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="medium-2 columns">
							<label for="" class="right inline">Selected</label>
						</div>
						<div class="medium-10 columns">
							<div class="row">
								<div class="medium-6 columns end products-wrapper">
									<select name="products[]" id="sel_product" multiple="multiple"></select>
								</div>
								<div class="medium-6 columns end categories-wrapper">
									<select name="categories[]" id="sel_category" multiple="multiple"></select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="medium-2 columns">
							<label for="offerType" class="right inline">Discount Type</label>
						</div>
						<div class="medium-10 columns">
							<input type="radio" value="1" name="offer_type" id="of_per"><label for="of_per">percentage</label>
							<input type="radio" value="2" name="offer_type" id="of_rs"><label for="of_rs">rupees</label>
						</div>
					</div>
					<div class="row">
						<div class="medium-2 columns">
							<label for="amount" class="right inline">Amount of Discount</label>
						</div>
						<div class="medium-5 end columns">
							<input type="text" id="amount" name="amount">
						</div>
					</div>
					<div class="row">
						<div class="medium-2 columns">
							<label for="active" class="right inline">Active</label>
						</div>
						<div class="medium-2 end columns">
							<input type="checkbox" checked id="active" name="active" value="1">
						</div>
					</div>
					<div class="row">
						<div class="medium-5 columns">
							&nbsp;
							@if (count($errors) > 0)
							    <div class="alert alert-danger">
							        <ul>
							            @foreach ($errors->all() as $error)
							                <li class="danger">{{ $error }}</li>
							            @endforeach
							        </ul>
							    </div>
							@endif
						</div>
						<div class="medium-2 end columns">
							<p class="text-right">
								<input type="submit" class="button tiny" value="Create Offer">
							</p>
						</div>
					</div>
				{!! Form::close(); !!}
			</div>
			<div class="content" id="weekly"></div>
			<div class="content" id="monthly"></div>
		</div>		
		
	</div>
	
@stop
@section ('scriptsContent')
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/select2.min.js"></script>
	<script type="text/javascript" src="js/trolley-forms.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			$('#daily_date, #end_date, #start_date').datepicker({
				dateFormat: "dd-mm-yy",
			});


			//select for 
			var cateWrapper = $('.categories-wrapper');
			var prodWrapper = $('.products-wrapper');
			$('#selectFor').on('change', function(){
				var selected = $(this).val();
				if(selected == 'product'){
					cateWrapper.hide();
					prodWrapper.show();
				}else if(selected == 'category'){
					prodWrapper.hide();
					cateWrapper.show();
				}
			});
			$('#selectFor').trigger('change');
			//var data = [{ id: 0, text: 'enhancement' }, { id: 1, text: 'bug' }, { id: 2, text: 'duplicate' }, { id: 3, text: 'invalid' }, { id: 4, text: 'wontfix' }];
			var productLists =[];
			var categoryLists =[];
			$.when(http_get('admin/offer/data/sync')).then(function(response){
				$.each(response.products, function(i, item){
					var product = {};
					product['id'] = item.id;
					product['text'] = item.product_name;
					productLists[i] = product;
				});
				$.each(response.categories, function(i, item){
					var category = {};
					category['id'] = item.id;
					category['text'] = item.category_name;
					categoryLists[i] = category;
				});
				populateSelects(productLists, categoryLists);
			});
			function populateSelects(productLists, categoryLists){
				console.log(productLists);
				$('#sel_product').select2({
					data: productLists
				});
				$('#sel_category').select2({
					data: categoryLists
				});
			}
		});
	</script>
@stop