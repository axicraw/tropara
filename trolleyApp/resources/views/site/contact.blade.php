@extends ('site/master')

@section ('content')
@include('site.partials.header_middle')
<div class="full-width page-content login-wrapper">
  <div class="row">
    <div class="small-12 columns">
      <h1 class="main-page-title text-center">
        Contact Us
      </h1>
    </div>
  </div>
  <div class="row">
    <div class="small-12 large-8 columns large-centered">
      <h4>&nbsp;</h4>
      <div class="row plain">
        <div class="small-6 columns">
          <h4><i class="fa fa-map-marker"></i> Address</h4>
          <p class="tight">
            Trolleyin,<br>
            Trichy,<br>
            Tamil Nadu.
          </p>
        </div>
        <div class="small-6 columns">
          <h4><i class="fa fa-Phone"></i> Contact</h4>
          <p class="tight">
            Sales: 8122225588<br>
            Enquiry: 9443385256<br>
            Email: info@trolleyin.com        
          </p>
        </div>
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