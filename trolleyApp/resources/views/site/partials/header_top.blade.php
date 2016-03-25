    <div class="full-width header-top">
      <div class="row">
        <div class="large-2 columns left-sect show-for-large-up">
          <div class="row">
            <div class="small-4 columns">
              <p>Newbie?</p>
            </div>
            <div class="small-8 columns end">
              <div class="tour-wrapper">
                <p class="">
                  <a href="#">TAKE A TOUR</a>
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="small-6 medium-3 large-2 columns middle-sect">
          <p><i class="fa fa-phone"></i> <a href="#" data-dropdown="helpline" data-options="is_hover:true; hover_timeout:5000;align:bottom;">Helpline : {{$settings['helpline']}}</a></p>
          <ul id="helpline" class="f-dropdown" data-dropdown-content>
            <li><strong>Help</strong> {{$settings['helpline']}}</li>
            <li><strong>Sales</strong> {{$settings['sales']}}</li>
            <li><strong>Delivery</strong> {{$settings['delivery']}}</li>
          </ul>
        </div>
        <div class="small-6 medium-9 large-8  end columns right-sect">
          <div class="row">
            <div class="large-3 columns show-for-large-up">
              <div class="row">
                <div class="small-3 columns">
                  <label class="right inline">City</label>
                </div>
                <div class="small-9 columns">
                  <select name="" id="" class="tiny">
                    <option value="">Trichy</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="medium-4 large-3 columns show-for-medium-up">
              <div class="row">
                <div class="small-3 columns">
                  <label class="right inline">Area</label>
                </div>
                <div class="small-9 columns">
                  <select name="area" id="deli-area">
                    @if(count($areas) > 0)
                      @foreach($areas as $area)
                        <option value="{{$area->id}}"
                          @if (isset($user))
                            @if($user->area_id == $area->id)
                              selected
                            @endif
                          @elseif(Session::has('deli_area'))
                            @if(Session::get('deli_area') == $area->id)
                              selected
                            @endif
                          @endif
                        >{{$area->area_name}}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
              </div>
            </div>
            <div class="medium-5 large-4 columns show-for-medium-up">
              <div class="row">
                <div class="small-5 columns">
                  <label class="right inline">Delivery Time</label>
                </div>
                <div class="small-7 columns">
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
            <div class="small-12 medium-3 large-2 columns">
              <div class="row">
                <div class="small-12 columns">
                  <p class="text-right">
                    @if ($user = Sentinel::check())
                      <a data-dropdown="user-menu" data-options="is_hover:true; hover_timeout:3000" href="#">
                        @if($user->name)
                          Hello {!! substr($user->name, 0, 9) !!}
                        @else
                         <i class="fa fa-user"></i> My Account 
                        @endif
                       
                      <i class="fa fa-caret-down"></i></a>
                      <ul id="user-menu" class="tiny f-dropdown" data-dropdown-content>
                        <li><a href="/account">Profile</a></li>
                        <li><a href="/account/myorders">Orders</a></li>
                        <li><a href="/logout">Logout</a></li>
                      </ul>
                    @else

                      <a href="#" data-reveal-id="loginModal"><i class="fa fa-user"></i> Login / Signup</a>
                    @endif
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>