@extends ('site/master')
@section ('cssContent')
  <link rel="stylesheet" href="css/jquery-ui/ui-lightness/jquery-ui.min.css">
@stop
@section ('content')
@include('site.partials.header_middle')
<div class="full-width page-content login-wrapper">

  <div class="row ">

    <div class="medium-8 columns medium-offset-2">
      <div class="plain-content">
        <h4 class="text-center title">Product Return Form</h4>
        {!! Form::open(array('route'=>'processreturn')) !!}
          <p class="tight">&nbsp;</p>

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
            <div class="medium-12 columns">
              <div class="row">
                <div class="medium-4 columns">
                  <label for="pids" class="right inline">Products *</label>
                </div>

                <div class="medium-6 end columns">
                  <select name="products[]" id="pids" multiple="multiple">
                    @if(isset($checkout))
                      @foreach($checkout->orders as $order)
                        @foreach($returns as $return)
                          <option value="{{$order->id}}"
                          @if($order->id == $return->order_return[0]['orders']->id)
                            disabled
                          @endif
                          >{{$order->product->product_name}}</option>
                        @endforeach
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
                <div class="medium-4 columns">
                  <label for="name" class="right inline">Name *</label>
                </div>
                <div class="medium-6 end columns">
                  <input id="name" type="text" name="name" required>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="medium-12 columns">
              <div class="row">
                <div class="medium-4 columns">
                  <label for="email" class="right inline">Email *</label>
                </div>
                <div class="medium-6 end columns">
                  <input id="email" type="email" name="email" required>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="medium-12 columns">
              <div class="row">
                <div class="medium-4 columns">
                  <label for="mobile" class="right inline">Mobile *</label>
                </div>
                <div class="medium-6 end columns">
                  <input id="mobile" type="text" name="mobile" required>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="medium-12 columns">
              <div class="row">
                <div class="medium-4 columns">
                  <label for="address" class="right inline">Address *</label>
                </div>
                <div class="medium-6 end columns">
                  <textarea id="address" name="address" required></textarea>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="medium-12 columns">
              <div class="row">
                <div class="medium-4 columns">
                  <label for="reason" class="right inline">Reason *</label>
                </div>
                <div class="medium-6 end columns">
                  <textarea id="reason" name="reason" required></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="medium-10 columns">
              <p class="text-right tight">
                <button type="button tiny">Confirm Return</button>
              </p>
            </div>
          </div>

        {!! Form::close() !!}</div>
    </div>
  </div>
</div>

@include('site.partials.footer_middle')
@stop

@section('page-modal')

@stop

@section('scriptsContent')

   <script src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/trolley-forms.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){

        $('#dop').datepicker({
          dateFormat: "dd-mm-yy",
        });
      });


  </script>
@stop