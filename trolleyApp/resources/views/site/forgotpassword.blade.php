@extends ('site/master')

@section ('content')
@include('site.partials.header_middle')
<div class="full-width page-content login-wrapper">

  <div class="row ">
    <div class="small-12 medium-8 large-4 columns large-centered medium-centered">
      <h4 class="text-center">Forgot Your Password?</h4>
      {!! Form::open(array('route'=>'forgotconfirm')) !!}

      <div class="row">
        <div class="small-12 columns">
          <label for="email">Enter your email</label>
          <input type="text" name="email">
        </div>
      </div>
      <div class="row">
        <div class="small-12 columns">
          <p class="tiny tex-center">You will receive an email with a link to reset your password. Click it to reset it.</p>
        </div>
      </div>
      <div class="row">
        <div class="small-12 columns">
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
        <p class="text-center">
          <button type="button tiny" type="submit">Reset Password</button>
        </p>
      </div>

      {!! Form::close() !!}
    </div>
  </div>
</div>

@include('site.partials.footer_middle')
@stop

@section('page-modal')

@stop

@section('scriptsContent')

@stop