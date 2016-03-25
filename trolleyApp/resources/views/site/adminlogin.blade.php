@extends ('site/blank')

@section ('content')
<div class="full-width page-content admin-login-wrapper">

  <div class="row">
    {!! Form::open(array('route'=>'adminauth')) !!}
    <div class="medium-4 columns medium-offset-4">
      <div class="logo-wrapper">
        <img src="images/logo_color.png" alt="">
      </div>
      <h4 class="text-center primary">Administrator</h4>
      <div class="row">
        <div class="medium-12 columns">
          <input type="text" name="email" placeholder="EMAIL">
        </div>
      </div>
      <div class="row">
        <div class="medium-12 columns">
          <input type="password" name="password" placeholder="PASSWORD">
        </div>
      </div>
      <div class="row">
        <div class="medium-12 columns">
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
      </div>
      <div class="row">
        <div class="medium-12 columns">
          <p class="text-center">
            <button class="button">Login</button>
          </p>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>

</div>

@stop

@section('page-modal')

@stop

@section('scriptsContent')

@stop