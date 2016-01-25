@extends ('site/master')

@section ('content')
@include('site.partials.header_middle')
<div class="full-width page-content login-wrapper">

  <div class="row ">
    <div class="medium-4 columns medium-offset-4">
      <h4 class="text-center">Forgot Your Password?</h4>
      {!! Form::open(array('route'=>'forgotconfirm')) !!}

      <div class="row">
        <div class="medium-12 columns">
          <label for="email">Enter your email</label>
          <input type="text" name="email">
        </div>
      </div>
      <div class="row">
        <div class="mediu 12 columns">
          <p class="tiny tex-center">You will receive an email with a link to reset your password. Click it to reset it.</p>
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


  </script>
@stop