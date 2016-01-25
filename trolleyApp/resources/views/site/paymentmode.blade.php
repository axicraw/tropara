@extends ('site/master')

@section ('content')
@include('site.partials.header_middle')
<div class="full-width payment-mode-wrapper">

  <div class="row page-content">
    <div class="medium-8 columns medium-offset-2">
      <ul class="accordion" data-accordion>
        <li class="accordion-navigation">
          <a href="#to">
            <div class="row">
              <div class="medium-4 columns"><i class="fa fa-user"></i> LOGGED IN</div>
              <div class="medium-8 columns">{{$user->email}}</div>
            </div>
          </a>
          <div id="to" class="content active">
            <div class="row">
              <div class="medium-5 end columns">
                <p>
                  ADDRESS : 
                  @if(strlen(Session::get('tmp_address')) > 2)
                    {{Session::get('tmp_address')}}
                    <br>
                    <a href="/cart/myaddress" class="micro">My Address</a>
                  @elseif(strlen($user->address) > 2)
                     {{$user->address}}, {{$user->area->area_name}}
                     <br>
                     <a href="#" data-reveal-id="diffAddress" class="micro">Different Address?</a>
                  @else
                     <a href="/account?redirect=cart/paymentmode" class="button tiny">Add Address</a>
                  @endif
                    <br>
                    <span class="tiny">
                    Delivery Charges: 
                    @if($delivery_cost > 0)
                      {{$delivery_cost}}
                    @else
                      Free
                    @endif
                    </span>
                </p>
              </div>
            </div>
          </div>
        </li>
        <li class="accordion-navigation">
          <a href="#items">
            <div class="row">
              <div class="medium-4 columns"><i class="fa fa-shopping-cart"></i> ORDER LIST</div>
              <div class="medium-8 columns">Items - {{$noofitems}} | Total  <i class="fa fa-rupee"></i> {{$total+$delivery_cost}}</div>
            </div>
          </a>
          <div id="items" class="content">
            <div class="row">
              <div class="medium-12">         
                <table width="96%" class="payment-cart-table">
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
              </div>
            </div>
          </div>
        </li>
        <li class="accordion-navigation">
          <a href="#pay"><i class="fa fa-rupee"></i> PAYMENT MODE</a>
          <div id="pay" class="content">
            <div class="row">
              <div class="medium-12 columns end">
                <ul class="tabs vertical" data-tab>
                  <li class="tab-title active"><a href="#credit">Credit Card</a></li>
                  <li class="tab-title"><a href="#net">Net Banking</a></li>
                  <li class="tab-title"><a href="#debit">Debit Card</a></li>
                  <li class="tab-title"><a href="#cod">Cash On Delivery</a></li>
                </ul>
                <div class="tabs-content">
                  <div class="content active" id="credit">Credit Card details</div>
                  <div class="content" id="net">Net Banking details</div>
                  <div class="content" id="debit">Debit Card details</div>
                  <div class="content" id="cod">
                    <div class="inner-content">
                      <a href="cart/checkout" class="button">Confirm Order</a>
                    </div>
                  </div>
                </div>
            </div>
            </div>
          </div>
        </li>
      </ul>
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