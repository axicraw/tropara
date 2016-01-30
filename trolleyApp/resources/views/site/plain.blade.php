@extends ('site/master')

@section ('content')
@include('site.partials.header_middle')
<div class="full-width page-content payment-mode-wrapper">

  <div class="row page-content ">
    <div class="columns medium-10 medium-offset-1">
     <div class="plain-content">
        <h4 class="title main text-center">{{$title}}</h4>
       <p class="content">
         {!! $content !!}
       </p>
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