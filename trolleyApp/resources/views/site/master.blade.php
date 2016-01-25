<!doctype html>
<html class="no-js" lang="en">
  <head>
    <base href="{{url()}}">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Trolleyin</title>

    <link rel="icon" href="favicon.png" type="image/ico"> 
    <link rel="stylesheet" href="css/foundation-icons/foundation-icons.css" />
    <link rel="stylesheet" href="css/flaticon/flaticon.css" />
    <link rel="stylesheet" href="css/slider-pro.min.css" />
    <link rel="stylesheet" href="css/slick.css" />
    <link rel="stylesheet" href="css/slick-theme.css" />
    <link rel="stylesheet" href="css/app.css" />
    @yield ('cssContent')

    <script src="js/modernizr.js"></script>
  </head>
  <body>
    @yield ('content')
    <div class="full-width footer-bottom">
      <div class="row">
        <div class="small-8 columns"></div>
        <div class="small-4 columns"></div>
      </div>
    </div>
    <div id="loginModal" class="reveal-modal medium" data-reveal aria-hidden="true" role="dialog">
      <div class="modal-header">
        <h4><i class="fa fa-user"></i> LOGIN / SIGNUP</h4>
      </div>
      <div class="modal-body">
        <div class="row login-wrapper">
          <div class="medium-6 columns veg-bg">
           <div class="white-overlay">
              <div class="logo-wrapper">
               <p class="text-center tight">
                 <img src="images/logo_color.png" alt="">
               </p>
             </div>
             <p><br>Hello. Welcome to Trolleyin.com. Its a great pleasure to sign you up with us. You can register with us and have an incredible shopping exprience</p>
             <div class="row">
               <div class="medium-6 columns">
                 <p class="">
                   <a href="#" class="button success" data-reveal-id="signupModal">Register Here.</a>
                 </p>
               </div>
               <div class="medium-6 columns">
                 <div class="shop-image-wrapper">
                   <img src="../images/manwithcart.png" alt="">
                 </div>
               </div>
             </div>
           </div>
          </div>
          <div class="medium-6 columns">
            <h5>Already Registered</h5>
              <div class="row">
                <div class="medium-12 columns">
                  <label for="email">
                    Email
                    <input type="email" name="email" id="email" required="required">
                  </label>
                </div>
              </div>
              <div class="row">
                <div class="medium-12 columns">
                  <label for="password">
                    Password
                    <input type="password" name="password" id="password" required="required">
                  </label>
                </div>
              </div>
              <div class="row">
                <div class="medium-6 columns">
                  <p class="tight">
                    <button class="button tight" id="loginBtn">Login</button><br>
                  </p>
                </div>
                <div class="medium-6 columns">
                  <p class="text-right tight">
                    <a href="forgotpassword" class="">Forgot Password?</a>
                  </p>
                </div>
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
                <div class="medium-12 columns">
                  <h6>Login with social accounts</h6>
                  <ul class="social-login-btns">
                    <li><a href="authsocial/login/facebook" class="button micro fb"><i class="fa fa-facebook"></i> Facebook</a></li>
                    <li><a href="authsocial/login/google" class="button micro go"><i class="fa fa-google-plus"></i> Google</a></li>
                    <li><a href="" class="button micro"><i class="fa fa-twitter tw"></i> Twitter</a></li>
                  </ul>
                </div>
              </div>
          </div>
        </div>
      </div>
      <a class="close-reveal-modal" aria-label="Close">&#215;</a>
    </div>
    <div id="signupModal" class="reveal-modal small" data-reveal aria-hidden="true" role="dialog">
      <div class="modal-header">
        <div class="row collapse">
          <div class="medium-6 columns">
            <h4><i class="fa fa-user-plus"></i> New Account</h4>
          </div>
          <div class="medium-6 columns">
            <h4 class="">
              <small><a href="#" data-reveal-id="loginModal">Already Registerd?</a></small>
            </h4>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <div class="row reg-wrapper">
          <div class="medium-12 columns">
              <div class="row">
                <div class="medium-12 columns">
                  <label for="mobile">
                    Mobile No
                    <input type="text" name="mobile" id="mobile" required>
                  </label>
                </div>
              </div>
              <div class="row">
                <div class="medium-12 columns">
                  <label for="email">
                    Email
                    <input type="email" name="email" id="email" required>
                  </label>
                </div>
              </div>
              <div class="row">
                <div class="medium-12 columns">
                  <label for="password">
                    Password
                    <input type="password" name="password" id="password" required>
                  </label>
                </div>
              </div>
              <div class="row">
                <div class="medium-12 columns">
                  <label for="cpassword">
                    Confirm Password
                    <input type="password" name="password_confirmation" id="cpassword" required>
                  </label>
                </div>
              </div>
              <div class="row">
                <div class="medium-12 columns">
                  <label for="area">
                    Area
                  </label>
                  <select name="area_id" id="area_id">
                    @if(count($areas) > 0)
                      @foreach($areas as $area)
                        <option value="{{$area->id}}">{{$area->area_name}}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="medium-12 columns">
                  <label for="iagree">
                  <input id="iagree" type="checkbox" value="1" required name="terms">
                  I Agree with the <a href="/TermsAndConditions">Terms and conditions.</a>
                  </label>
                </div>
              </div>
              <div class="row">
                <div class="medium-6 columns">
                  <div class="logo-wrapper" style="width:100px">
                    <img src="images/logo_color.png" alt="">
                  </div>
                </div>
                <div class="medium-6 columns">
                  <p class="text-right tight">
                    <button class="button" id="registerBtn">Create New Account</button>
                  </p>
                </div>
              </div>
          </div>
        </div>
      </div>
      <a class="close-reveal-modal" aria-label="Close">&#215;</a>
    </div>
    @if(!Session::has('deli_area'))
     <div id="areaSelectModal" class="reveal-modal tiny" data-reveal aria-hidden="true" role="dialog">
      <div class="modal-header">
        <div class="row collapse">
          <div class="medium-12 columns">
            <h4><i class="fa fa-map-marker"></i> Select Delivery Area</h4>
          </div>
        </div>
      </div>
      {!! Form::open(array('route'=>'change.area')) !!}
      <div class="modal-body">
        <div class="row modal-area-wrapper">
          <div class="medium-12 columns">
              <div class="row">
                <div class="medium-12 columns">
                  <label for="city">
                    City
                  </label>
                  <select name="city" id="city">
                    <option value="Trichy">Trichy</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="medium-12 columns">
                  <label for="area">
                    Area
                  </label>
                  <select name="area" id="area">
                    @if(count($areas) > 0)
                      @foreach($areas as $area)
                        <option value="{{$area->id}}">{{$area->area_name}}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="medium-12 columns">
                  <label for="time">
                    Time Delivery
                  </label>
                  <select name="time" id="time">
                    <option value="08:00am - 11:00 am">08:00am - 11:00 am</option>
                    <option value="12:00am - 04:00 pm">12:00am - 04:00 pm</option>
                    <option value="05:00pm - 08:00 pm">05:00pm - 08:00 pm</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="medium-6 columns">
                  <div class="logo-wrapper" style="width:100px">
                    <img src="images/logo_color.png" alt="">
                  </div>
                </div>
                <div class="medium-6 columns">
                  <p class="tight text-right">
                    <button type="submit" class="button">Select</button>
                  </p>
                </div>
              </div>
          </div>
        </div>
      </div>
      {!! Form::close() !!}
      <a class="close-reveal-modal" aria-label="Close">&#215;</a>
      </div>
    @endif
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/velocity.min.js"></script>
    <script src="js/sliderPro.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/toastr.min.js"></script>

    <script src="js/echo.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/services/ajax.js"></script>
    <script src="js/trolleyin.js"></script>
    <script src="js/trolleycart.js"></script>
    <script src="js/jquery.marquee.min.js"></script>
    <script>
    echo.init({
      offset: 100,
      throttle: 250,
      unload: false,
      callback: function (element, op) {
        console.log(element, 'has been', op + 'ed')
      }
    });
    
    $("#flashmarq").marquee({
      duration:8000,
      gap:5,
      duplicated:false
    });
    $('#areaSelectModal').foundation('reveal', 'open');

    $(document).ready(function(){

      ///////////////////// php conditioned /////////////////
      @if(session()->has('toasttext'))
          console.log('has session');
          {{--*/ $toasttext = session()->get('toasttext'); /*--}}
          {{--*/ $toasttype = session()->get('toasttype'); /*--}}
          toastr.{{$toasttype}}('{{$toasttext}}', {timeOut:3500});
      @endif

      /////////////////////////////////////////////////////
    });

    </script>
    @yield('scriptsContent')
  </body>
</html>

