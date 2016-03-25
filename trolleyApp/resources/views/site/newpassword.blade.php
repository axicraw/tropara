@extends ('site/master')

@section ('content')
@include('site.partials.header_middle')
<div class="full-width page-content login-wrapper">

  <div class="row ">
    <div class="small-12 medium-8 large-4 columns medium-centered large-centered">
      <h4 class="text-center">Reset Password</h4>
      {!! Form::open(array('route'=>'resetpassword')) !!}
        <input type="hidden" hidden name="token" value="{{$token}}">
        <input type="hidden" hidden name="user_id" value="{{$user->id}}">
      <div class="row">
        <div class="small-12 columns">
          <label for="password">New Password</label>
          <input type="password" name="password">
        </div>
      </div>
      <div class="row">
        <div class="small-12 columns">
          <label for="password_confirmation">Confirm Password</label>
          <input type="password" name="password_confirmation">
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