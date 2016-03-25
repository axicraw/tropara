<div class="full-width header-middle">
  <div class="row">
    <div class="small-2 medium-1 columns hide-for-large-up">
      <div class="">
        <button class="tiny mobile-menu-launcher"><i class="fa fa-bars fa-2x"></i></button>
      </div>
    </div>
    <div class="small-5 medium-3 columns ">
      <div class="logo-wrapper">
        <div class="row">
          <div class="small-12 columns">
            <p class="tight">
              <a href="/"><img src="images/logo_color_white.png" alt="Trolleyin logo"></a>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="medium-6 large-7 show-for-medium-up columns">
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
               <a href="#" id="main-search-btn" class="button postfix"><i class="fi-magnifying-glass"></i></a>

            </div>
          </div>
        </div>

      </div>
    </div>

    
    <div class="small-3 medium-2 large-2 columns">
     <div class="row">
       <div class="small-12 columns">
         <!-- <div class="cart-wrapper-shadow"> -->
           <div class="row cart-wrapper">
            <a href="cart/view">
              <div class="large-4 columns show-for-large-up">  
                <p class="text-center cart-icon tight">
                  <img src="images/cart.png" alt="Trolleyin Cart">
                </p>
              </div>
              <div class="small-12 medium-12 large-8 columns cart-numbers" id="header-cart-wrapper">              
                 <h6 class="shop-cart tight">Cart<span class="label round" id="header-cart-items">0</span> </h6>
                 <p class="tight tiny cart-total">Rs. <span id="header-cart-price">0</span></p>
              </div>
            </a>
           </div>
         <!-- </div> -->
       </div>
     </div>
    </div>
    <div class="small-2 columns show-for-small-only">
     <p class="text-center">
        <a href="" class="mobile-search-toggle"><i class="fa fa-search"></i></a>
     </p>
    </div>
  </div>
  <div class="mobile-search-wrapper">
    <div class="row collapse  show-for-small-only">
      <div class="small-9 columns">
        <input type="text" class="mobile-search-input" placeholder="Search here...">
      </div>
      <div class="small-3 columns"> 
        <button type="submit" id="mobile-search-submit" class="button tiny mobile-search-submit">Search</button>
      </div>
    </div>
  </div>
  <div class="row collapse hide-for-large-up mobile-menu-row">
    <div class="small-12 columns">
      {{--*/ 
        $categories = $categories->sortBy('did');
      /*--}}
      <ul class="mobile-menu-wrapper">
      @foreach ($categories as $category)
        @if(count($category->children) > 0)
          <li class="has-child">
                <a href="category/{{$category->category_name}}">{{ $category->category_name }} </a>
                <button class="button menu-drop tight"><i class="fa fa-chevron-down"></i></button>
                <div class="sublevel">
                  <ul class="sublists">
                    @foreach($category->children->sortBy('did') as $child)
                      @if(count($child->children) > 0)
                      <li class="has-child">
                        <a href="category/{{ $child->category_name }}">{{$child->category_name}} ({{count($child->products)}})</a>
                        <button class="button submenu-drop tight"><i class="fa fa-chevron-down"></i></button>
                          <div class="sublevel2">
                            <ul class="sublists">
                              @foreach($child->children as $gc)
                                <li>
                                  <a href="category/{{ $gc->category_name }}">{{ $gc->category_name }} ({{count($gc->products)}})</a>
                                </li>
                              @endforeach
                            </ul>
                          </div>
                      </li>
                      @else
                        <li>
                          <a href="category/{{ $child->category_name }}">{{ $child->category_name }} ({{count($child->products)}})</a>
                        </li>
                      @endif
                    @endforeach
                  </ul>
                </div>
            
          </li>
        @else
          <li>
            <a href="category/{{ $category->category_name }}">{{ $category->category_name }} ({{count($category->products)}})</a>
          </li>

        @endif
        
      @endforeach
      </ul>
    </div>
  </div>
</div>