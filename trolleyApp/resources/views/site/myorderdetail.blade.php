@extends ('site/master')

@section ('content')
@include('site.partials.header_middle')
<div class="full-width account-view">
  <div class="row page-content">
    <div class="small-12 large-10 columns large-centered account-wrapper">
      <div class="row collapse">
        <h4>Order Detail - No {{$checkout->id}}</h4>
        <div class="small-12 columns">
          <table width="100%" class="cart-table">
            <tr>
              <th>Product</th>
              <th>Qty</th>
              <th>PRICE</th>
              <th width="80">NOS</th>
              <th>SUBTOTAL</th>
            </tr>
            @foreach($checkout->orders as $order)
            <tr>
              <td>{{ $order->product->product_name }}
                  
              </td>
              <td>{{ $order->pqty }}</td>
              <td>{{ $order->offered_price }}</td>
              <td>{{ $order->nos }}</td>
              <td>{{ $order->offered_price *  $order->nos}}</td>
            </tr>
            @endforeach
            
          </table>
          <div class="small-12 columns">
            <p class="micro">
              <a class="link-normal" href="/productreturn/{{$checkout->id}}">Return</a>
            </p>
          </div>
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

   //update cart nos
   $('input.pnos').on('change', function(){
    var rid = $(this).data('rid');
    var nos = $(this).val();
    var postData = {};
    postData['nos'] = nos;
    postData['id'] = rid;
    console.log(rid);
    $.when(http_post('cart/updateNos', postData)).then(function(response){
      location.reload();
    }, function(response){
      console.log('cart update failed');
    })
   });

  </script>
@stop