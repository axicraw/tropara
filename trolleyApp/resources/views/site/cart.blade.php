@extends ('site/master')

@section ('content')
@include('site.partials.header_middle')
<div class="full-width cart-view">
  <div class="row page-content">
    <div class="medium-12 columns">
      
      @if($count > 0)
      <h3 class=""><i class="fa fa-shopping-cart "></i> Your Cart</h3>
        <table width="100%" class="cart-table">
          <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>PRICE</th>
            <th width="80">NOS</th>
            <th>SUBTOTAL</th>
          </tr>
          @foreach($cart as $item)
          <tr>
            <td>{{ $item->name }}
                <a href="#" class="danger link-anchor" data-url="cart/remove/{{ $item->rowid }}" data-method="get">remove</a>
            </td>
            <td>{{ $item->options->pqty }}{{ $item->options->pqunit }}</td>
            <td>{{ $item->price }}</td>
            <td><input type="number" value="{{ $item->qty }}" class="pnos" 
                  data-proid="{{ $item->id }}" data-pqtyid="{{ $item->options->pid }}" data-rid="{{ $item->rowid }}" min="1"/></td>
            <td>{{ $item->subtotal }}</td>
          </tr>
          @endforeach
          
        </table>
      
        <div class="row">
          <div class="medium-6 columns">
            @if($user)
              Ship To: 
              <p>
                @if(strlen(Session::get('tmp_address')) > 2)
                  {{Session::get('tmp_address')}}
                  <br>
                  <a href="/cart/myaddress" class="micro">My Address</a>
                @elseif(strlen($user->address) > 2)
                  {{$user->address}}
                  <br>
                  <a href="#" data-reveal-id="diffAddress" class="micro">Different Address?</a>
                @else
                  
                  <a href="/account?redirect=cart/view" class="button tiny">Add Address</a>
                @endif
              </p>
            @endif
          </div>
          <div class="medium-6 columns">
            @if($delivery_cost > 0)
              <p class="text-right tight">Delivery Cost: <i class="fa fa-rupee"></i> {{$delivery_cost}}
                <br><span class="micro">Delivery Free for orders above <i class="fa fa-rupee micro"></i> 250.</span>
              </p>
              <p class="text-right">TOTAL:  <i class="fa fa-rupee"></i> {{ $total + $delivery_cost }}</p>
            @else
              <p class="text-right tight">Delivery Cost: Free.
              </p>
              <p class="text-right">TOTAL:  <i class="fa fa-rupee"></i> {{ $total }}</p>
            @endif
            
           
              <p class="text-right">
                <a href="/" class="button success">Shop More</a>
                <a  type="submit" href="cart/paymentmode" class="button primary" 
                  @if($count < 1)
                    disabled
                  @endif
                >Place Order</a>
              </p>
          </div>
        </div>
      @else
        <div class="row">
          <div class="medium-8 columns medium-offset-2">
            <div class="panel">
              <p class="text-center">There are no products in the cart</p>
            </div>
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
<div id="diffAddress" class="reveal-modal small" data-reveal aria-hidden="false" role="dialog">
  <div class="row collapse">
    <div class="medium-6 columns">
      <h4>Ship to a different Address</h4>
    </div>
  </div>
  <div class="row reg-wrapper">
    <div class="medium-12 columns">
      {!! Form::open(array('route'=>'cart.changeaddress')) !!}
        <div class="row">
          <div class="medium-12 columns">
           <div class="row">
             <div class="medium-2 columns">
               <label for="title" class="right inline">Title</label>
             </div>
             <div class="medium-3 end columns">
               <select name="title" id="title">
                 <option value="Mr.">Mr</option>
                 <option value="Mrs.">Mrs</option>
                 <option value="Miss.">Miss</option>
               </select>
             </div>
           </div>
           <div class="row">
             <div class="medium-12 columns">
               <div class="row">
                 <div class="medium-2 columns">
                   <label for="name" class="right inline">Name</label>
                 </div>
                 <div class="medium-6 end columns">
                   <input id="name" type="text" name="name">
                 </div>
               </div>
             </div>
           </div>
           <div class="row">
             <div class="medium-2 columns">
               <label for="address" class="right inline">Address</label>
             </div>
             <div class="medium-6 end columns">
               <textarea id="address" name="address" cols="30" rows="4"></textarea>
             </div>
           </div>
           <div class="row">
             <div class="medium-2 columns">
               <label for="area_id" class="inline">Area *</label>
             </div>
             <div class="medium-6 end columns">
               <select name="area_id" id="area_id" required="required">
                 @if(count($areas) > 0)
                   @foreach($areas as $area)
                     <option value="{{$area->id}}">{{$area->area_name}}</option>
                   @endforeach
                 @endif
               </select>
             </div>
           </div>
          </div>
        </div>
        <div class="row">
          <div class="medium-6 columns">
            <button class="submit button tiny">Add Address</button>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>
<!-- <div id="scooter" class="row">
  <div class="medium12 columns">
    <p class="text-right">
      <img src="images/scooter.gif" alt="">
    </p>
  </div>
</div> -->
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
    var pro_id = $(this).data('proid');
    var pqty_id = $(this).data('pqtyid');
    var rid = $(this).data('rid');
    var nos = $(this).val();
    var postData = {};
    postData['nos'] = nos;
    postData['id'] = rid;
    postData['product_id'] = pro_id;
    postData['pqty_id'] = pqty_id;
    console.log(rid);
    $.when(http_post('cart/updateNos', postData)).then(function(response){
      location.reload();
    }, function(response){
      console.log('cart update failed');
    })
   });
   //  trigger.on('click', function(e){
   //    console.log('clicked');
   //    e.preventDefault();
   //    scooter.show();
   //    setTimeout(function(){
   //      scooter.hide()
   //    }, 1000);
   //  })
   // });
  </script>
@stop