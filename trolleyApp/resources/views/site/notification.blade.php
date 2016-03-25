@extends ('site/master')

@section ('content')
@include('site.partials.header_middle')
<div class="full-width page-content payment-mode-wrapper">

  <div class="row">
    <div class="small-12 large-8 columns large-centered">
      <div class="panel">
        <p class="text-center">  {!! html_entity_decode($notification) !!} .</p>
      </div>
    </div>
  </div>
</div>

@include('site.partials.footer_middle')
@stop

@section('page-modal')

@stop

@section('scriptsContent')

@stop