@extends ('site/master')

@section ('content')
@include('site.partials.header_middle')
<div class="full-width page-content payment-mode-wrapper">

  <div class="row">
    <div class="medium-4 columns medium-offset-4">
       
      <div class="panel">
        <h4 class="text-center">Change Modile No:</h4>
          @if (isset($errors))
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li class="danger tiny tight text-center">{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
        {!! Form::open(array('route'=>'savemobile', 'autocomplete'=>'off')) !!}
          <input type="hidden" name="id" hidden value="{{$user->id}}">
          <input type="text" class=" activate-pin" name="mobile" value={{$user->mobile}}>

              <p class="text-center tight">
                <button type="submit" class="button tiny tight">Save Mobile</button><br>
              </p>
            </div>

          
        {!! Form::close() !!}

      </div>
<!-- 
      <p class=" tiny">
        Dont have phone access now? <a href="" class="plain">Activate through Email.</a>
      </p> -->
      
    </div>
  </div>
</div>

@include('site.partials.footer_middle')
@stop

@section('page-modal')

@stop

@section('scriptsContent')
  <script type="text/javascript">
  
  $(document).ready(function(){

  });
  </script>
@stop