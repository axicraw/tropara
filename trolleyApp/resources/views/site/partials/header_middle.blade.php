<div class="full-width header-middle">
  <div class="row">
    <div class="small-3 columns">
      <div class="logo-wrapper">
        <div class="row">
          <div class="small-12 columns">
            <p class="tight">
              <a href="/"><img src="images/logo_color_white.png" alt=""></a>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="small-7 columns">
      <div class="row search-wrapper">
        <div class="small-12 columns">
          <div class="div row marquee-wrapper">
            <div class="medium-12 columns">
              <div class="marquee" id="flashmarq">
                @foreach($flashes as $flash)
                  {{$flash->text}} 
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - 
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                @endforeach
              </div>
            </div>
          </div>
          <div class="row collapse main-search-bar">
            <div class="small-10 columns">
              <input type="text" class="ajax-search-input" placeholder="Search by Products, Brand or Category" data-target="main-search">
              <ul class="ajax-search-lists" data-id="main-search">

              </ul>
            </div>
            <div class="small-2 columns">
               <a href="#" class="button postfix"><i class="fi-magnifying-glass"></i> Search</a>

            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="small-2 columns">
     <div class="row">
       <div class="small-12 columns">
         <!-- <div class="cart-wrapper-shadow"> -->
           <div class="row cart-wrapper">
            <a href="cart/view">
              <div class="small-4 columns">
                <p class="text-center cart-icon tight">
                  <img src="images/cart.png" alt="">
                </p>
              </div>
              <div class="small-8 columns cart-numbers" id="header-cart-wrapper">              
                 <h6 class="shop-cart tight">Cart<span class="label round" id="header-cart-items">0</span> </h6>
                 <p class="tight tiny cart-total">Rs. <span id="header-cart-price">0</span></p>
              </div>
            </a>
           </div>
         <!-- </div> -->
       </div>
     </div>
    </div>
  </div>
</div>