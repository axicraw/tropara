@extends ('site/master')


@section ('content')
    @include('site.partials.header_top')
    @include('site.partials.header_middle')
    <div class="full-width content-top">

      <div class="row collapse">
        <div class="banner-loader-wrapper">
          
          <div class="banner-loader-content">
            <p class="tight text-center">
              <img src="images/logo_color.png" class="logo" alt="Trolleyin Logo"><br>Loading<br>
              <img src="images/ajax_loader/loader.gif" alt="" class="ajax-loader">
            </p>
          </div>
          
        </div>
        <div class="large-3 columns show-for-large-up">
           @include('site.partials.side_cate')
           
        </div>
        <div class="medium-9 large-7 small-12 columns">
          <div class="row home-slider">
            
            <div class="slider-pro" id="tro-slider">
              <div class="sp-thumbnails tight">
                @foreach($banners as $banner)
                <div class="sp-thumbnail">
                    <h5 class="sp-thumbnail-text tight">{{$banner->title}}</h5>
                    <p class="sp-thumbnail-text tight">{{$banner->caption}}</p>
                </div>
                @endforeach
              </div> 
              <div class="sp-slides">
                @foreach($banners as $banner)
                <div class="sp-slide">
                  <img src="images/banners/{{$banner->image['image_name']}}" alt="{{$banner->title}}">
                </div>                
                @endforeach
              </div>
                <!-- end sp-slides -->
              
            </div>
          </div>
        </div>
        <div class="medium-3 large-2 columns show-for-medium-up">
          <h5 class="text-center highlight no-margin">OFFERS</h5>
          <!-- <div class="row">
            <button class="button button-secondary"><i class="fi-arrow-up"></i></button>
          </div> -->
         
          <div class="offer-slider">
            @if(count($offers) > 0)
              @foreach($offers as $offer)
                
                @if(count($offer->products) > 0)
                  @foreach($offer->products as $product)
                    <div class="offer-slide">
                      <a href="/product/{{$product->product_name}}?id={{$product->id}}">
                        <div class="img-wrapper">
                          <img src="images/products/{{$product->images[0]['image_name']}}" alt="{{$product->product_name}}">
                        </div>
                        <p class="side-offer-product tight text-center">{{$product->product_name}}<span class="label round alert off">
                          {{$offer->amount}}
                          @if($offer->offer_type === 1)
                            %
                          @else
                            <i class="fa fa-rupee"></i>
                          @endif
                          Off
                        <!-- </span><br><span class="side-offer-price"><i class="fa fa-rupee"></i>100</span></p> -->
                      </a>
                    </div>
                  @endforeach
                @endif
                @if(count($offer->categories) > 0)
                  @foreach($offer->categories as $category)
                  
                    
                    @if(count($category->products) > 0)
                      @foreach($category->products as $product)
                        <div class="offer-slide">
                          <a href="/product/{{$product->product_name}}?id={{$product->id}}">
                            <div class="img-wrapper">
                              <img src="images/products/{{$product->images[0]['image_name']}}" alt="{{$product->product_name}}">
                            </div>
                            <p class="side-offer-product tight text-center">{{$product->product_name}}<span class="label round alert off">
                              {{$offer->amount}}
                              @if($offer->offer_type === 1)
                                %
                              @else
                                <i class="fa fa-rupee"></i>
                              @endif
                              Off
                            <!-- </span><br><span class="side-offer-price"><i class="fa fa-rupee"></i>100</span></p> -->
                          </a>
                        </div>
                      @endforeach
                    @endif
                  @endforeach
                @endif
                @if(count($offer->brands) > 0)
                  @foreach($offer->brands as $category)
                  
                    
                    @if(count($category->products) > 0)
                      @foreach($category->products as $product)
                        <div class="offer-slide">
                          <a href="/product/{{$product->product_name}}?id={{$product->id}}">
                            <div class="img-wrapper">
                              <img src="images/products/{{$product->images[0]['image_name']}}" alt="{{$product->product_name}}">
                            </div>
                            <p class="side-offer-product tight text-center">{{$product->product_name}}<span class="label round alert off">
                              {{$offer->amount}}
                              @if($offer->offer_type === 1)
                                %
                              @else
                                <i class="fa fa-rupee"></i>
                              @endif
                              Off
                            <!-- </span><br><span class="side-offer-price"><i class="fa fa-rupee"></i>100</span></p> -->
                          </a>
                        </div>
                      @endforeach
                    @endif
                  @endforeach
                @endif
              @endforeach

            @endif
            <!-- 
            <div class="offer-slide">
              <div class="img-wrapper">
                <img src="images/products/eggs.jpg" alt="">
              </div>
              <p class="side-offer-product tight text-center">Eggs <span class="label round alert off">15% Off</span><br><span class="side-offer-price"><i class="fa fa-rupee"></i>80</span></p>
            </div>
            <div class="offer-slide">
              <div class="img-wrapper">
                <img src="images/products/broccoli.jpg" alt="">
              </div>
              <p class="side-offer-product tight text-center">Broccoli <span class="label round alert off">10% Off</span><br><span class="side-offer-price"><i class="fa fa-rupee"></i>75</span></p>
            </div>
            <div class="offer-slide">
              <div class="img-wrapper">
                <img src="images/products/chilli.jpg" alt="">
              </div>
              <p class="side-offer-product tight text-center">Chilli <span class="label round alert off">10% Off</span><br><span class="side-offer-price"><i class="fa fa-rupee"></i>20</span></p>
            </div> -->
          </div>
        </div>
      </div>
    </div>
    <div class="full-width content-feats show-for-large-up">
      <div class="row collapse">
        <div class="small-3 columns">
          <div class="row content-feat">
            <div class="small-2 columns">
              <p><i class="flaticon-deliverytruck5 icon-large"></i></p>
            </div>
            <div class="small-10 columns">
              <h5 class="tight">FREE SHIPPING</h5>
              <p class="tight">For Selected Areas</p>
            </div>
          </div>
        </div>
        <div class="small-3 columns">
          <div class="row content-feat">
            <div class="small-2 columns">
              <p><i class="flaticon-sale21 icon-large"></i></p>
            </div>
            <div class="small-10 columns">
              <h5 class="tight">Weekly Sale</h5>
              <p class="tight">Get Offers weekly</p>
            </div>
          </div>
        </div>
        <div class="small-3 columns">
          <div class="row content-feat">
            <div class="small-2 columns">
              <p><i class="flaticon-multiple25 icon-large"></i></p>
            </div>
            <div class="small-10 columns">
              <h5 class="tight">Free Membership</h5>
              <p class="tight">Avail Our membership plans</p>
            </div>
          </div>
        </div>
        <div class="small-3 columns">
          <div class="row content-feat">
            <div class="small-2 columns">
              <p><i class="flaticon-tags10 icon-large"></i></p>
            </div>
            <div class="small-10 columns">
              <h5 class="tight">Genuine Price</h5>
              <p class="tight">Products are priced for quality</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- 
    *****************  New Products ******************
     -->
    <div class="full-width new-arrivals">
      <div class="row caro-title collapse">
        <div class="small-12 columns">
          <h1 class="tight main-page-title"><span class="inner-text">New Products</span></h1>
        </div>
      </div>
      <div class="row caro-wrapper">
          @foreach($new_products as $new_product)
          <div class="small-4 medium-3 large-2 end columns">
            <a href='product/{{ $new_product->product_name }}?id={{$new_product->id}}' class="caro-link">
              <div class="caro-prod">
                <div class="row add-to-wrapper">
                  <div class="small-6 columns">
                    <p class="text-center add-to-cart tight"><button data-pid="{{ $new_product->product_name }}" class="button warning ATC">Add to Cart</button></p>
                  </div>
                  <div class="small-6 columns">
                    <p class="text-center buy-now"><button class="button success">Buy Now</button></p>
                  </div>
                </div>
                <div class="img-wrapper prod-img">
                  <p class="tight text-center">
                   
                    <img src="images/img_loader/loader.gif" data-echo="images/products/{{ $new_product->images->first()->image_name }}" alt="{{$new_product->product_name}}">
                  </p>
                </div>
              
                <p class="prod-title text-center tight">
                  {!! substr($new_product->product_name, 0, 32) !!}                  
                </p>
                <div class="prod-det">
                  <div class="row">
                                       
                  </div>
                </div>
              </div></a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    

@include('site.partials.footer_top')
@include('site.partials.footer_middle')
@stop

@section('page-modal')

@stop

@section('scriptsContent')
<script type="text/javascript">
  //banner preloader
    bannerWrapper = $('.banner-loader-wrapper');
    loader = bannerWrapper.find('.banner-loader-content');
    loader.fadeIn("slow");
    //alWrapper.show();
    jQuery('.content-top').ready(function() {
      bannerWrapper.hide();
    });

 $(document).ready(function() {
    console.log('inner script working');
      $( '#tro-slider' ).sliderPro({
        width:700,
        height:315,
        buttons:false,
        thumbnailsPosition:'top',
        thumbnailWidth:170,
        thumbnailHeight:48
      });


      /**** sticky header ***/
        //sticky top
      var mainHeader = $('.header-middle');
      $(document).on('scroll', function(){
        if(($(this).scrollTop() > 30)){
          mainHeader.addClass('fixed');
        }else{
          mainHeader.removeClass('fixed');
        }
      });
      
  });
</script>
@stop