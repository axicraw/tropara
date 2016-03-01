@extends ('site/master')

@section ('content')
@include('site.partials.header_middle')
<div class="full-width page-content login-wrapper">

  <div class="row">
    <div class="medium-8 columns medium-offset-2">
      <h4>&nbsp;</h4>
      <div class="row plain">
        <div class="medium-6 columns">
          <h4><i class="fa fa-map-marker"></i> Address</h4>
          <p class="tight">
            street1<br>
            street2<br>
            Trichy - 6200001,
            Tamil Nadu.
          </p>
        </div>
        <div class="medium-6 columns">
          <h4><i class="fa fa-Phone"></i> Contact</h4>
          <p class="tight">
            Sales: 8122225588<br>
            Enquiry: 9443385256<br>
            Email: info@trolleyin.com        
          </p>
        </div>
      </div>
    </div>
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