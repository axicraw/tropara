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
		$.when(http_get('cart/add/'+pid+'/'+priceId)).then(function(response){
			//updateCartView(response.count, response.total);
			getCartData();
		},
		function(){
			console.log('not added');
		})
	});

	//Category Page - update price on quantity change 
	$('.quantity-price').on('change', function(){
		val = $(this).find('option:selected').data('price');
		console.log(val);
		$(this).parents(".quantity-wrapper").find('.qty-price-wrapper .price-num').html(val);
		// $('#selected-price').html($(this).val());
		var priceId = $(this).find('option:selected').data('priceId');
		btnATC.data('price-Id', priceId);
		
	});
	$('.quantity-price').trigger('change');


	//Product Page - update price on quantity change 
	$('#product-price').on('change', function(){
		$('#selected-price').html($(this).val());
		var priceId = $(this).find('option:selected').data('priceId');
		btnATC.data('price-Id', priceId);
		console.log(priceId);
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
		})
	}
	getCartData();
});