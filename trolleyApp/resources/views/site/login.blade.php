@extends ('site/master')

@section ('content')
@include('site.partials.header_middle')
<div class="full-width page-content login-wrapper">

  <div class="row ">
    <div class="medium-4 columns show-for-medium-up">
      <p class="text-center"> 
        <img src="images/gro_basket.png" alt="">
      </p>
    </div>
    <div class="small-6 medium-4 columns">
      <div class="logo-wrapper">
        <img src="images/logo_color.png" alt="">
      </div>
      <p>Hello. Welcome to Trolleyin.com. Its a great pleasure to sign you up with us. You can register with us and have an incredible shopping exprience.</p>
      <a href="#" class="button success" data-reveal-id="signupModal">Register Here.</a>
    </div>
    <div class="small-6 medium-4 columns">
       <h4 >Login / Create Account</h4>
      <h5>Already Registered</h5>
        {!! Form::open(array('route'=>'authenticate')) !!}
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
            <!-- <button class="button" id="loginBtn">Login</button> -->
            <button type="submit" class="button">Submit</button>
          </div>
          <div class="medium-6 columns">
            <a href="/forgotpassword">Forgot Password?</a>
          </div>
        </div>
        <div class="row">
          <div class="medium-12 columns">
            @if(isset($toast))
              console.log('isset');
              @if(count($toast) > 0)
                console.log('have count');
                toastr.{{$toast['type']}}('{{$toast["text"]}}', {timeOut:3500});
              @endif
            @endif
            <h6>Login with social accounts</h6>
            <ul class="social-login-btns">
              <li><a href="authsocial/login/facebook" class="button micro fb"><i class="fa fa-facebook"></i> Facebook</a></li>
              <li><a href="authsocial/login/google" class="button micro go"><i class="fa fa-google-plus"></i> Google</a></li>
              <li><a href="authsocial/login/twitter" class="button micro"><i class="fa fa-twitter tw"></i> Twitter</a></li>
            </ul>
          </div>
        </div>
        {!! Form::close() !!}
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
      <!--         <div class="row">
         <div class="social-login">
            <h6>Login with social accounts</h6>
           <ul>
             <li><a href="">Facebook</a></li>
             <li><a href="">Google</a></li>
             <li><a href="">Twitter</a></li>
           </ul>
         </div>
        </div> -->
    </div>
  </div>
</div>

@include('site.partials.footer_middle')
@stop

@section('page-modal')

@stop

@section('scriptsContent')

@stop