@extends ('site/master')

@section ('content')
@include('site.partials.header_middle')
<div class="full-width page-content account-view">
  <div class="row">
    <div class="small-12 large-8 columns large-centered account-wrapper">
      <div class="row collapse">
        <div class="small-3 medium-3 columns">
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
        <div class="small-9 columns">
         <div class="tab-content-wrapper"><div class="row">
             <div class="large-6 columns large-centered">
                <h1 class="main-page-title">Personal Profile</h1>
             </div>
           </div>
            {!! Form::open(array('route'=>'account.save')) !!}
              <div class="row">
                <div class="small-12 columns">
                  <div class="row">
                    &nbsp;
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="danger">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                  </div>
                  <div class="row">
                    <div class="small-3 large-2 columns">
                      <label for="title" class="inline">Title</label>
                    </div>
                    <div class="small-9 large-3 end columns">
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
                <div class="small-12 columns">
                  <div class="row">
                    <div class="small-3 large-2 columns">
                      <label for="name" class="inline">Name *</label>
                    </div>
                    <div class="small-9 large-6 end columns">
                      <input id="name" type="text" name="name" value="{{$user->name}}" required="required">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="small-12 columns">
                  <div class="row">
                    <div class="small-3 large-2 columns">
                      <label for="mobile" class="inline">Mobile *</label>
                    </div>
                    <div class="small-9 large-6 end columns">
                      @if(strlen($user->mobile) > 9)
                      <label>{{$user->mobile}} / <a href="#" data-reveal-id="mobileModal">Change Mobile No</a></label> 
                      @else
                        <input id="mobile" type="text" name="mobile"  required="required">
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="small-12 columns">
                  <div class="row">
                    <div class="small-3 large-2 columns">
                      <label for="email" class="inline" >Email *</label>
                    </div>
                    <div class="small-3 large-6 end columns">
                      <input id="email" type="email" name="email" value="{{$user->email}}" required="required">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="small-12 columns">
                  <div class="row">
                    <div class="small-3 large-2 columns">
                      <label for="address" class="inline">Address *</label>
                    </div>
                    <div class="small-9 largw-6 end columns">
                      <textarea id="address" name="address" cols="30" rows="4" required="required">{{$user->address}}</textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="small-12 columns">
                  <div class="row">
                    <div class="small-3 large-2 columns">
                      <label for="area_id" class="inline">Area *</label>
                    </div>
                    <div class="small-9 large-6 end columns">
                      <select name="area_id" id="area_id" required="required">
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
                <div class="small-12 columns">
                  <div class="row">
                    <div class="small-3 large-2 columns">
                      <label for="cpas" class="">Password </label>
                    </div>
                    <div class="small-9 large-6 end columns">
                      <a href="#" data-reveal-id="passwordModal">Change Password</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="small-8 columns">
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
  <div class="row">
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
<div id="mobileModal" class="reveal-modal small" data-reveal aria-hidden="false" role="dialog">
  <div class="row">
    <div class="medium-6 columns">
      <h4>Change Mobile No</h4>
    </div>
  </div>
  <div class="row reg-wrapper">
    <div class="medium-12 columns">
      {!! Form::open(array('route'=>'savemobile')) !!}
        <input type="hidden" value="{{$user->id}}" name="id">
        <div class="row">
          <div class="medium-6 columns">
            <label for="mobile">
              New Mobile No
              <input type="text" name="mobile" id="mobile" >
            </label>
          </div>
        </div>
        <div class="row">
          <div class="medium-12 columns">
            <p class="text-right">
              <button class="submit button tiny">Save Mobile No</button>
            </p>
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
  
@stop