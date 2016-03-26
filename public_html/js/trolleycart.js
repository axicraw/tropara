$(document).ready(function(){



	// $(document).on('change', 'select.quantity-price', function(e){
	// 	e.preventDefault();
	// 	var price = $(this).find('option:selected').data('price');
	// 	var priceId = $(this).find('option:selected').data('price-id');
	// 	$(this).parents('.quantity-wrapper').find('.qty-price').html('Rs.'+price);
	// 	$(this).parents('.quantity-wrapper').find('button.ATC').data('price-id', priceId);
	// })
	// $('select.quantity-price').trigger('change');

	//add prod to cart session
	var btnATC = $('button.ATC');
	btnATC.on('click', function(e){
		e.preventDefault();
		var pid = $(this).data('pid');
		var priceId = $(this).data('price-id');
		console.log(pid, priceId);
		var pname = $(this).data('pname');
		$.when(http_get('cart/add/'+pid+'/'+priceId)).then(function(response){
			//updateCartView(response.count, response.total);
			if(pname.length > 0){
				toastr.success(pname + ' added to cart', {timeOut:3500});
			}
			else{
				toastr.success('product added to cart', {timeOut:3500});
			}
			getCartData();
		},
		function(){
			console.log('not added');
		});
	});

	//Category Page - update price on quantity change 
	$('.quantity-price').on('change', function(){
		val = $(this).find('option:selected').data('price');
		$(this).parents(".quantity-wrapper").find('.qty-price-wrapper .price-num').html('<i class="fa fa-rupee"></i> '+val);
		// $('#selected-price').html($(this).val());
		var priceId = $(this).find('option:selected').data('priceId');
		console.log(priceId);
		$(this).closest(".quantity-wrapper").find('button.ATC').data('price-Id', priceId);

		var qty = $(this).find('option:selected').data('qty');
		var unit = $(this).find('option:selected').data('unit');
		var price = $(this).find('option:selected').data('price');


		var mrps = $(this).closest('.product-wrapper').find('.mrp-wrapper');
		var save = $(this).closest('.product-wrapper').find('.save-wrapper');
		save.hide();

		
		$.each(mrps, function(i, item){
			var temp = $(item);
			var mrpQty = temp.data('qty');
			var mrpUnit = temp.data('unit');
			var mrp = temp.data('mrp');

			mrps.hide();

			var saveper = ((mrp-price)/mrp)*100;
			saveper = Math.round(saveper);
			console.log('save '+ saveper);
			console.log(qty+' and '+mrpQty+' / '+unit+'and'+mrpUnit);
			if(qty === mrpQty && unit === mrpUnit){
				if(saveper > 0 && saveper < 100){
					save.find('.save').text(saveper);
					save.show();
				}
				console.log('showing');
				temp.show();
				return false;
				
			}else{
				temp.hide();
				save.hide();
			}
		});
		
	});
	$('.quantity-price').trigger('change');


	//Product Page - update price on quantity change 
	$('#product-price').on('change', function(){
		$('#selected-price').html($(this).val());
		var priceId = $(this).find('option:selected').data('priceId');
		$('#product-buy-btn').data('price-Id', priceId);
		console.log(priceId);

		var qty = $(this).find('option:selected').data('qty');
		var unit = $(this).find('option:selected').data('unit');
		var price = $(this).find('option:selected').data('price');

		var mrps = $(this).closest('.product-detail-wrapper').find('.mrp-wrapper');
		var save = $(this).closest('.product-view').find('.save-wrapper');
		//save.hide();

		$.each(mrps, function(i, item){
			var temp = $(item);
			var mrpQty = temp.data('qty');
			var mrpUnit = temp.data('unit');
			var mrp = temp.data('mrp');

			mrps.hide();

			var saveper = ((mrp-price)/mrp)*100;
			saveper = Math.round(saveper);
			console.log(mrp+', '+price+'gives save '+ saveper);
			console.log(qty+' and '+mrpQty+' / '+unit+'and'+mrpUnit);
			if(qty === mrpQty && unit === mrpUnit){
				if(saveper > 0 && saveper < 100){
					save.find('.save').text(saveper);
					save.show();
				}
				console.log('showing');
				temp.show();
				return false;
				
			}else{
				temp.hide();
				save.hide();
			}
		});

		// console.log(btnATC.data('price-Id'));
	});
	$('#product-price').trigger('change');

	var headerCartWrapper = $('#header-cart-wrapper'),
		headerCartItems = headerCartWrapper.find('#header-cart-items'),
		headerCartPrice = headerCartWrapper.find('#header-cart-price');

	function updateCartView(count, total){
		headerCartItems.html(count);
		headerCartPrice.html(total);
	}

	function getCartData(){
		$.when(http_get('cart/get')).then(function(response){
			updateCartView(response.count, response.total);
		},
		function(){
			console.log('not returned');
		});
	}
	getCartData();
});