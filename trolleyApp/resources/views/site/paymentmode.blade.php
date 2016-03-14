@extends ('site/master')

@section ('content')
@include('site.partials.header_middle')
<div class="full-width payment-mode-wrapper">

  <div class="row page-content">
    <div class="medium-8 columns medium-offset-2">
      <ul class="accordion" data-accordion id="paymentaccordin">
        <li class="accordion-navigation">
          <a href="#to">
            <div class="row">
              <div class="medium-4 columns"><i class="fa fa-user"></i> LOGGED IN</div>
              <div class="medium-7 columns">{{$user->email}}</div>
              <div class="medium-1 columns">
                @if(strlen(Session::get('tmp_address')) > 5 || strlen($user->address) > 5)
                <i class="fa fa-check fa-2x success"></i>
                @endif
              </div>
            </div>
          </a>
          <div id="to" class="content active">
            <div class="row">
              <div class="medium-6 end columns">
                <div class="row">
                  <div class="medium-6 columns">
                    <p>                     
                      ADDRESS : 
                    </p>
                  </div>
                  <div class="medium-6 columns">                      
                    <p>
                      @if(strlen(Session::get('tmp_address')) > 5)
                        {{Session::get('tmp_address')}}
                        <br>
                        <a href="/cart/myaddress" class="micro">My Address</a>
                      @elseif(strlen($user->address) > 5)
                         {{$user->address}}, {{$user->area->area_name}}
                         <br>
                         <a href="#" data-reveal-id="diffAddress" class="micro">Different Address?</a>
                      @else
                         <a href="/account?redirect=cart/paymentmode" class="button tiny">Add Address</a>
                      @endif
                    </p>
                  </div>
                </div>
                
                <div class="row">
                  <div class="medium-6 columns">
                    <p>
                      DELIVERY CHARGES :
                    </p>
                  </div>
                  <div class="medium-6 columns">
                    <p class="text-right">
                    @if($delivery_cost === 'unknown') 
                      Unknown
                    @else
                      @if($delivery_cost > 0)
                        <i class="fa fa-rupee"></i> {{$delivery_cost}}
                      @else
                        Free
                      @endif
                    @endif
                    </p>
                  </div>
                </div>
                <div class="row">
                  <div class="medium-6 columns">
                   <p> DELIVERY TIME :</p>
                  </div>
                  <div class="medium-6 columns">
                   
                    <select name="" id="deli-time" class="tiny">
                      @foreach($dts as $dt)
                        <option value="{{$dt->id}}"
                          @if(Session::has('deli_time'))
                            @if(Session::get('deli_time') == $dt->id)
                              selected
                            @endif
                          @endif
                        >{{$dt->start}}-{{$dt->stop}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="medium-12 columns">
                <p class="text-right tight">

                  @if(strlen(Session::get('tmp_address')) > 5 || strlen($user->address) > 5)
                    <button data-trigger="items-link" class="button success trigger">Continue</button>
                  @else
                    <button class="button success trigger" disabled>Continue</button>
                  @endif

                </p>
              </div>
            </div>
          </div>
        </li>
        <li class="accordion-navigation">
          <a href="#items" id="items-link">
            <div class="row">
              <div class="medium-4 columns"><i class="fa fa-shopping-cart"></i> ORDER LIST</div>
              <div class="medium-7 columns">Items - {{$noofitems}} | Total  <i class="fa fa-rupee"></i> {{$total+$delivery_cost}}</div>
              <div class="medium-1 columns valid">
                @if(count($cart) > 0)
                <i class="fa fa-check fa-2x success"></i>
                @endif
              </div>
            </div>
          </a>
          <div class="accordin-mask">
            
          </div>
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
                  @if(count($cart) > 0)
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
                  @else
                    No products to checkout <a href="/" class="button success">Shop Now</a>
                  @endif
                  
                </table>
              </div>
            </div>
            <div class="row">
              <div class="medium-12 columns">
                <p class="text-right tight">

                  @if(count($cart) > 0)
                    <button data-trigger="pay-link" class="button success trigger">Continue</button>
                  @else
                    <button class="button success trigger" disabled>Continue</button>
                  @endif

                </p>
              </div>
            </div>
          </div>
        </li>
        <li class="accordion-navigation">
          <a href="#pay" id="pay-link"><i class="fa fa-rupee"></i> PAYMENT MODE</a>
          <div class="accordin-mask"></div>
          <div id="pay" class="content">
            <div class="row">
              <div class="medium-12 columns end">
                <ul class="tabs vertical" data-tab>
                  <li class="tab-title"><a href="#credit">Credit Card</a></li>
                  <li class="tab-title"><a href="#net">Net Banking</a></li>
                  <li class="tab-title"><a href="#debit">Debit Card</a></li>
                  <li class="tab-title active"><a href="#cod">Cash On Delivery</a></li>
                </ul>
                <div class="tabs-content">
                  <div class="content" id="credit">Will be available soon.</div>
                  <div class="content" id="net">Will be available soon.</div>
                  <div class="content" id="debit">Will be available soon.</div>
                  <div class="content active" id="cod">
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

   //trigger accordion
   var trigger = $('button.trigger');
   trigger.on('mousedown', function(e){
    e.preventDefault();
    var tarid = $(this).data('trigger');
    var tar = 'a#'+tarid;
    $(tar).trigger('click');
    $(tar).siblings('.accordin-mask').hide();
    $(tar).find('.valid').show();

   });

    $('#paymentaccordin').on('toggled', function (event, accordion) {
       console.log(accordion);
    });

  </script>
@stop