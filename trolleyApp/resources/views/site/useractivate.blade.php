@extends ('site/master')

@section ('content')
@include('site.partials.header_middle')
<div class="full-width page-content payment-mode-wrapper">

  <div class="row">
    <div class="small-12 medium-8 large-4 columns large-centered medium-centered">
      <p class="tight tiny">A pin has been sent to your mobile ending with <span class="main"><strong>***{{ substr($user->mobile, 6)}}.</strong></span><br>Enter the pin to activate.</p>
      
      <div class="panel">
        <h4 class="text-center">Enter Pin</h4>
          @if (isset($errors))
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li class="danger tiny tight text-center">{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          @if (isset($success))
              <p class="text-center success tiny"> {{ $success }}</p>
          @endif
        {!! Form::open(array('route'=>'activateuser', 'autocomplete'=>'off')) !!}
          <input type="hidden" name="id" hidden value="{{$user->id}}">
          <input type="text" class="text-center activate-pin" name="pin">

          <div class="row collapse">
            <div class="small-12 columns large-8">
              <p class="text-left micro tight">Why is this necessary <a data-dropdown="activationNeed" aria-controls="drop1" aria-expanded="false"><i class="fa fa-question-circle"></i></a>
                    <br>Did'nt receive sms? <a href="/sendpinagain?id={{$user->id}}" class="plain">Send Again.</a>
              </p>
              <div id="activationNeed" data-dropdown-content class="f-dropdown content" aria-hidden="true" tabindex="-1">
                <p class="micro tight">We needed customers mobile no to inform the purchase details through sms. We will also use this 
                    number to call you in order we cant find your address provided.
                </p>
              </div>
            </div>
            <div class="small-12 medium-10 columns large-4">
              <p class="text-right tight">
                <button type="submit" class="button tiny tight">Activate</button><br>
              </p>
            </div>
          </div>
          
        {!! Form::close() !!}

      </div>

      <p class=" tiny">
        Entered wrong mobile number? <a href="/changemobile?id={{$user->id}}" class="plain">Change mobile number</a>
      </p>
      
    </div>
  </div>
</div>

@include('site.partials.footer_middle')
@stop

@section('page-modal')

@stop

@section('scriptsContent')

@stop