@extends ('site/master')

@section ('content')
@include('site.partials.header_middle')
<div class="full-width page-content payment-mode-wrapper">

  <div class="row">
    <div class="medium-8 columns medium-offset-2">
      <div class="panel">
        <p class="success text-center">  {!! html_entity_decode($notification) !!} .</p>
      </div>
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