@extends ('site/master')

@section ('content')
@include('site.partials.header_top')
<div class="full-width">
  <div class="row page-content">
    <h5>Order Placed</h5>
    <p>Thank You. Your Order has been placed successfully.</p>
  </div>
</div>

@include('site.partials.footer_middle')
@stop

@section('page-modal')

@stop

@section('scriptsContent')
  <script type="text/javascript">
  //change the price based on quantity select
   $(".quantity-price").on('change', function(){
    var opt = $(this).find('option:selected');
    var price = opt.data('qprice');
    console.log(price);
    var clo = $(this).parents('.quantity-wrapper').find('.qty-price');
    clo.html('<span class="price-num">&#8377;'+ price+'</span>')
   });
   $(".quantity-price").trigger('change');


  </script>
@stop