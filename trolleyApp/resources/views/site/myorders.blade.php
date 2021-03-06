@extends ('site/master')

@section ('content')
@include('site.partials.header_middle')
<div class="full-width account-view">
  <div class="row page-content">
    <div class="large-10 columns large-centered account-wrapper">
      <div class="row collapse">
        <div class="small-3 columns">
          <div class="side-menu">
            
            <div class="row">
              <ul>
                <li><a href="/account">Profile</a></li>
                <li class="active"><a href="/account/myorders">Orders</a></li>
                <li><a href="/account/myreturns">Returns</a></li>
              </ul>
            </div>  
          </div>
        </div>
        <div class="small-9 columns">
          <div class="tab-content-wrapper">
           
            <ul class="tabs" data-tab>
              <h4>My Orders</h4>
              <li class="tab-title active"><a href="#c-orders">Current Orders</a></li>
              <li class="tab-title"><a href="#history">History</a></li>
            </ul>
            <div class="tabs-content">
              <div class="content active" id="c-orders">
                <table width="100%">
                  <tr>
                    <th>Orders</th>
                    <th>Order Placed On</th>
                    <th>Status</th>
                  </tr>
                  @foreach($user->checkouts as $checkout)
                    @if($checkout->status != 'Delivered')
                      <tr>
                        <td>
                          @foreach($checkout->orders as $order)
                            <span class="label" >{{$order->product->product_name}} - {{$order->pqty}} x {{$order->nos}}</span>
                          @endforeach
                          <p class="micro tight">
                            Shipping To: <br>{{$checkout->address}}
                            <br>
                            
                          </p>
                          
                        </td>
                        <td>
                          {{ Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
                        </td>
                        <td>
                          <a href="#" data-dropdown="id{{$checkout->id}}" aria-controls="drop1" aria-expanded="false">
                            {{$checkout->status}}
                          </a>
                          <div id="id{{$checkout->id}}" class="f-dropdown detail-link-box" data-dropdown-content aria-hidden="true" tabindex="-1">
                            <a href="/myorder/{{$checkout->id}}">Details</a>
                          </div>
                        </td>
                      </tr>
                    @endif
                  @endforeach
                </table>
              </div>
              <div class="content" id="history">
                <table width="100%">
                  <tr>
                    <th>Orders</th>
                    <th>Order Placed On</th>
                    <th>Status</th>
                  </tr>
                  @foreach($user->checkouts as $checkout)
                    @if($checkout->status === 'Delivered')
                      <tr>
                        <td>
                          @foreach($checkout->orders as $order)
                            <span class="label">{{$order->product->product_name}} - {{$order->pqty}} x {{$order->nos}}</span>
                          @endforeach
                          <p class="micro tight">Delivered At: <br>{{$checkout->address}}</p>
                        </td>
                        <td>
                          {{ Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
                        </td>
                        <td>
                          <a href="#" data-dropdown="id{{$checkout->id}}" aria-controls="drop1" aria-expanded="false">
                            {{$checkout->status}}
                          </a>
                          <div id="id{{$checkout->id}}" class="f-dropdown" data-dropdown-content aria-hidden="true" tabindex="-1">
                            <a href="/checkout/detail/{{$checkout->id}}"></a>
                          </div>
                        </td>
                      </tr>
                    @endif
                  @endforeach
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<div id="passwordModal" class="reveal-modal small" data-reveal aria-hidden="false" role="dialog">
  <div class="row collapse">
    <div class="small-6 columns">
      <h4>Change Password</h4>
    </div>
  </div>
  <div class="row reg-wrapper">
    <div class="small-12 columns">
      {!! Form::open(array('route'=>'account.changepassword')) !!}
        <div class="row">
          <div class="small-12 columns">
            <label for="password">
              New Password
              <input type="password" name="password" id="password" >
            </label>
          </div>
        </div>
        <div class="row">
          <div class="small-12 columns">
            <label for="cpassword">
              Confirm Password
              <input type="password" name="cpassword" id="cpassword" >
            </label>
          </div>
        </div>
        <div class="row">
          <div class="small-6 columns">
            <button class="submit button tiny">Change Password</button>
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