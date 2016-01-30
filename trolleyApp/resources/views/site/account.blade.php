@extends ('site/master')

@section ('content')
@include('site.partials.header_middle')
<div class="full-width page-content account-view">
  <div class="row">
    <div class="medium-8 columns medium-offset-2 account-wrapper">
      <div class="row collapse">
        <div class="medium-3 columns">
          <div class="side-menu">
            
            <div class="row">
              <ul>
                <li class="active"><a href="/account">Profile</a></li>
                <li><a href="/account/myorders">Orders</a></li>
                <li><a href="/account/myreturns">Returns</a></li>
              </ul>
            </div>  
          </div>
        </div>
        <div class="medium-9 columns">
         <div class="tab-content-wrapper"><div class="row">
             <div class="medium-6 columns medium-offset-2">
                <h3>Personal Profile</h3>
             </div>
           </div>
            {!! Form::open(array('route'=>'account.save')) !!}
              <div class="row">
                <div class="medium-12 columns">
                  <div class="row">
                    <div class="medium-2 columns">
                      <label for="title" class="right inline">Title</label>
                    </div>
                    <div class="medium-3 end columns">
                      <select name="title" id="title">
                        <option 
                          @if($user->title == "Mr.")
                            selected = "selected"
                          @endif
                        value="Mr.">Mr</option>
                        <option 
                          @if($user->title == "Mrs.")
                            selected = "selected"
                          @endif
                        value="Mrs.">Mrs</option>
                        <option  
                          @if($user->title == "Miss.")
                            selected = "selected"
                          @endif
                        value="Miss.">Miss</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="medium-12 columns">
                  <div class="row">
                    <div class="medium-2 columns">
                      <label for="name" class="right inline">Name</label>
                    </div>
                    <div class="medium-6 end columns">
                      <input id="name" type="text" name="name" value="{{$user->name}}">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="medium-12 columns">
                  <div class="row">
                    <div class="medium-2 columns">
                      <label for="mobile" class="right inline">Mobile</label>
                    </div>
                    <div class="medium-6 end columns">
                      <input id="mobile" type="text" name="mobile"  value="{{$user->mobile}}" required="required">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="medium-12 columns">
                  <div class="row">
                    <div class="medium-2 columns">
                      <label for="email" class="right inline" >Email</label>
                    </div>
                    <div class="medium-6 end columns">
                      <input id="email" type="email" name="email" value="{{$user->email}}" required="required">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="medium-12 columns">
                  <div class="row">
                    <div class="medium-2 columns">
                      <label for="address" class="right inline">Address</label>
                    </div>
                    <div class="medium-6 end columns">
                      <textarea id="address" name="address" cols="30" rows="4">{{$user->address}}</textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="medium-12 columns">
                  <div class="row">
                    <div class="medium-2 columns">
                      <label for="area_id" class="right inline">Area</label>
                    </div>
                    <div class="medium-6 end columns">
                      <select name="area_id" id="area_id">
                        @if(count($areas) > 0)
                          @foreach($areas as $area)
                            <option value="{{$area->id}}"
                                @if($user->area_id == $area->id)
                                  selected="selected"
                                @endif
                            >{{$area->area_name}}</option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="medium-12 columns">
                  <div class="row">
                    <div class="medium-2 columns">
                      <label for="email" class="right inline">Password</label>
                    </div>
                    <div class="medium-6 end columns">
                      <a href="#" data-reveal-id="passwordModal">Change Password</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="medium-8 columns">
                  <p class="text-right"><button type="submit" class="button tiny">Save</button></p>
                </div>
              </div>
           
              <!-- <div class="row">
                <div class="medium-12 columns">
                  <div class="row">
                    <div class="medium-3 columns">
                      <label for="email" class="right inline">Date of Birth</label>
                    </div>
                    <div class="medium-9 columns">
                      <input type="email" name="email">
                    </div>
                  </div>
                </div>
              </div> -->
            {!! Form::close() !!}</div>
        </div>
      </div>
    </div>
  </div>

</div>
<div id="passwordModal" class="reveal-modal small" data-reveal aria-hidden="false" role="dialog">
  <div class="row collapse">
    <div class="medium-6 columns">
      <h4>Change Password</h4>
    </div>
  </div>
  <div class="row reg-wrapper">
    <div class="medium-12 columns">
      {!! Form::open(array('route'=>'account.changepassword')) !!}
        <div class="row">
          <div class="medium-12 columns">
            <label for="password">
              New Password
              <input type="password" name="password" id="password" >
            </label>
          </div>
        </div>
        <div class="row">
          <div class="medium-12 columns">
            <label for="cpassword">
              Confirm Password
              <input type="password" name="cpassword" id="cpassword" >
            </label>
          </div>
        </div>
        <div class="row">
          <div class="medium-6 columns">
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