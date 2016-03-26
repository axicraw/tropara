<!doctype html>
<html class="no-js" lang="en">
  <head>
    <base href="{{url()}}">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Trolleyin</title>
    <link rel="stylesheet" href="css/allstyles.css" />
    @yield ('cssContent')

    <script src="js/modernizr.js"></script>
  </head>
  <body>
    <div class="full-width header-top admin">
        <div class="medium-6 columns"></div>
        <div class="medium-6 columns">
            <p class="text-right">
                <a href="logout">Logout</a>
            </p>
        </div>
    </div>
    <div class="side-nav admin">
        <div class="logo-wrapper">
            <img src="images/logo.png" alt="Trolley Logo">
        </div>
        <ul class="side-menu">
            
            <li><a href="admin/dashboard">Dashboard</a></li>
            <li>
                <a href="#">Global Settings</a>
                <ul class="submenu">
                    <li><a href="admin/globalsettings">Settings</a></li>
                    <li><a href="admin/delivery">Delivery Time</a></li>
                    <li><a href="admin/voidsearch">Search</a></li>
                    <li><a href="admin/area">Location</a></li>
                </ul>
            </li>
            <li><a href="admin/user">Users</a></li>
            <li><a href="admin/category">Categories</a></li>
            <li><a href="admin/product">Products</a></li>
            <li><a href="admin/brand">Brands</a></li>
            <li><a href="admin/order">Orders</a></li>
            <li><a href="admin/order/returns">Returns</a></li>
            <li><a href="admin/offer">Offers</a></li>
            <li><a href="admin/banner">Banners</a></li>
            <li><a href="admin/flashtext">Flash Text</a></li>
        </ul>
    </div>
    <div class="admin admin-content">
        @yield ('content')
    </div>
    <div id="delalert" class="reveal-modal small" data-reveal aria-labelledby="Alert" aria-hidden="true" role="dialog">
      <div class="row">
          <div class="modal-header">
              <h4 id="modalTitle">Alert</h4>
          </div>
          <div class="modal-body">
              <p>Are you sure you want to do this action?</p>
          </div>
          <div class="modal-footer">
              <p class="text-right">
                  <a id="formyes" href="" class="button tiny" >Yes</a>
              </p>
          </div>
      </div>
      <a class="close-reveal-modal" aria-label="Close">&#215;</a>
    </div>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/jsrender.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/velocity.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/services/ajax.js"></script>
    <script src="js/trolleyin.js"></script>
    <script>


        $(document).on('click', 'input.delalert, button.delalert', function(e){
            console.log('clicked on del');
            //e.stopPropagation();
            $('#delalert').foundation('reveal', 'open');
            var parForm = $(this).parents('form');
            $(document).on('click', 'a#formyes', function(){
                parForm.submit();
            });


            
        });
    </script>

    @yield ('scriptsContent')
  </body>
  </html>