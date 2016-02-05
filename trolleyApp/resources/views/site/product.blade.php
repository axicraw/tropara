@extends ('site/master')

@section ('content')
@include('site.partials.header_middle')

<div class="full-width content-top veg">
  <div class="row collapse">
    <div class="small-3 columns">
      <div class="row">
        <ul class="side-menu">
                  
          @if(count($main_category->children) > 1)
            <h5 class="highlight no-margin lshadow"><a class="cate-drop" href=""><i class="fi-list"></i> <span>Category</span></a> <i class="fa fa-angle-right"></i> <span class="sub-heading">{{$main_category->category_name}}</span></h5>
            @foreach ( $main_category->children as $subcategory )
                <li class="sub-cate"><a href="category/{{ $subcategory->category_name }}">{{ $subcategory->category_name }}</a>         </li>
            @endforeach
          @else
            <h5 class="highlight no-margin lshadow"><a class="cate-drop" href=""><i class="fi-list"></i> <span>Category</span></a> <i class="fa fa-angle-right"></i> 
              <span class="sub-heading">
                @foreach ( $categories as $category )
                  @if($category->id === $main_category->parent_id)
                    {{$category->category_name}}
                  @endif
                @endforeach
              </span>
            </h5>
            @foreach ( $categories as $category )
              @if($category->parent_id === $main_category->parent_id)
                <li class="sub-cate"><a href="category/{{ $category->category_name }}">{{ $category->category_name }}</a>
                  
                </li>
              @endif
            @endforeach
          @endif
        </ul>
      </div>
<!--       <div class="row collapse todays">
        <div class="small-12 columns">
          <h5 class="highlight">
            Todays Special
          </h5>
          <div class="row caro-wrapper collapse">
              <div class="small-12 columns">
                <div class="caro-prod">
                  <div class="row add-to-wrapper">
                    <div class="small-6 columns">
                      <p class="text-center add-to-cart tight"><button class="button warning">Add to Cart</button></p>
                    </div>
                    <div class="small-6 columns">
                      <p class="text-center buy-now"><button class="button success">Buy Now</button></p>
                    </div>
                  </div>
                  <div class="img-wrapper prod-img">
                    <p class="tight text-center">
                      <img src="images/fruits.jpg" alt="product-image">
                    </p>
                  </div>
                  
                  <p class="prod-title text-center tight">
                    Product1
                  </p>
                  <p class="text-center tight prod-desc">
                    This is desc
                  </p>
                  <div class="prod-det">
                    <div class="row">
                      <div class="small-6 columns">
                        <p class="prod-price tight">&#8377; 20</p>
                      </div>
                      <div class="small-6 columns prod-rating">
                        <p class="text-right tight">
                          <i class="fi-star"></i>
                          <i class="fi-star"></i>
                          <i class="fi-star"></i>
                          <i class="fi-star"></i>
                          <i class="fi-star"></i>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
           
          </div>
        </div>
      </div> -->
    </div>
    <div class="small-9 columns">
      <div class="product-view">
          <div class="row">
            <div class="medium-5 columns">
              <div class="product-images-wrapper">

                <img src="images/img_loader/loader.gif" data-echo="images/products/{{  $product->images[0]['image_name'] }}" alt="">
                <!-- <div class="slider-pro" id="product-image-slider">
                  <div class="sp-slides">
                    @foreach ( $product->images as $image)
                      <div class="sp-slide">
                        <img src="images/products/{{ $image->image_name }}" alt="">
                      </div>                    
                    @endforeach
                  </div>
                  <div class="sp-thumbnails">
                    @foreach ( $product->images as $image)
                        <img src="images/products/{{ $image->image_name }}" alt="" class="sp-thumbnail">                   
                    @endforeach
                  </div>

                </div> -->
              </div>
            </div>
            <div class="medium-7 columns">
              <div class="product-detail-wrapper">
                <div class="row">
                  <div class="medium-12 columns">
                    <h3 class="product-name">{{ $product->product_name }} <span class="local-name">({{$product->local_name}})</span></h3>
                  </div>
                </div>
                <!-- <div class="row">
                  <div class="medium-6 columns prod-rating">
                    <p class="tight">
                      <i class="fi-star"></i>
                      <i class="fi-star"></i>
                      <i class="fi-star"></i>
                      <i class="fi-star"></i>
                      <i class="fi-star"></i>
                    </p>
                  </div>
                  <div class="medium-6 columns">
                    <a href="#">Reviews</a>
                  </div>
                </div> -->
                <div class="row quantity-wrapper">
                  <div class="medium-6 columns">
                    <p class="tight">Brand: {{ $product->brand->brand_name }}</p>
                  </div>             
                </div>
                <div class="row prod-price-wrapper">
                  <div class="medium-4 columns">
                    @if($product->out_of_stock)
                      <h4 class="danger"> Out Of Stock</h4>
                    @else
                      <h4 class="success"> In Stock</h4>
                    @endif
                      @if (($product->mrp->mrp) > 0)
                        <p class="danger strike-through tight">
                        MRP : Rs.{{ $product->mrp->mrp }}/{{ $product->mrp->qty }}{{ $product->mrp->unit->shortform }}
                        </p>
                      @endif
                   </div>
                  <div class="medium-8 columns">
                    @if ( $product->offers->count() > 0)
                      @foreach ($product->offers as $offer)
                        @if($offer->active == 1)
                          <div class="row collapse">
                            <div class="small-12 columns">
                              <p class="tiny success tight">
                                <span class="label success">Offer *</span>
                                  @if ( $offer->offer_type == 1 )
                                    {{ $offer->amount }}% Off for {{ $product->product_name }}
                                  @elseif ( $offer->offer_type == 2 )
                                    Rs.{{ $offer->amount }} Off on {{ $product->product_name }}
                                  @endif
                              </p>
                            </div>
                          </div>
                        @endif
                      @endforeach
                      <!-- <p class="micro">* Only one offer will be applicable. Whichever is higher will be reduced on checkout.</p> -->
                    @endif
                    @if ( $main_category->offers->count() > 0)
                      @foreach ($main_category->offers as $offer)
                        @if($offer->active == 1)
                          <div class="row collapse">
                            <div class="small-12 columns">
                              <p class="tiny success tight">
                                <span class="label success">Offer *</span>
                                  @if ( $offer->offer_type == 1 )
                                    {{ $offer->amount }}% Off for all {{ $main_category->category_name }}
                                  @elseif ( $offer->offer_type == 2 )
                                    Rs.{{ $offer->amount }} Off on all {{ $main_category->category_name }}
                                  @endif
                              </p>
                            </div>
                          </div>
                        @endif
                      @endforeach
                      <!-- <p class="micro">* Only one offer will be applicable. Whichever is higher will be reduced on checkout.</p> -->
                    @endif
                  </div>
                </div>
                  
                <div class="row">
                  <div class="medium-4 columns">
                    {{--*/ $lowest = $product->prices->sortBy('price')->first()/*--}}

                    <h4>Rs.  <span id="selected-price">{{ $lowest->price }}</span></h4>
                  </div>
                  <div class="medium-6 end columns">
                    <div class="row qty-select collapse">
                      <div class="medium-3 columns">
                        <span class="prefix">Qty</span>
                      </div>
                      <div class="medium-9 columns">
                        <select class="product-price" id="product-price">                          
                          @foreach($product->prices as $price)
                            <option class="price" value="{{ $price->price }}" data-price-id="{{ $price->id }}"
                              @if($price->id == $lowest->id)
                                selected
                              @endif 
                            >Rs. {{ $price->price }} / <small>{{ $price->qty }}{{ $price->unit->shortform }}</small></option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                @if(!$product->out_of_stock)
                  <div class="row">
                    <div class="medium-6 columns end">
                      <button class="button primary ATC" data-pid="{{ $product->id }}" data-price-id="0">Add To Cart</button>
                      <!-- <button class="button success">Buy Now</button> -->
                    </div>
                  </div>
                @endif
                <div class="row">
                  <div class="medium-12 columns">
                    <div class="prod-desc-wrapper">
                      @if(strlen($product->description['description']) > 2)
                      <h4>Description</h4>
                      <p>{{$product->description['description']}}</p>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
        <div class="product-grid-1">
            @if(count($main_category->products) > 0)
              <div class="row caro-title collapse">
                <div class="small-12 columns">
                  <h5 class="tight"><span class="inner-text">In {{$main_category->category_name}}</span></h5>
                </div>
              </div>
              <div class="row">
                @foreach ( $main_category->products as $cate_product)
                  <div class="small-3 end columns">
                    <div class="product-wrapper">
                      <a href="product/{{ $cate_product->id }}" class="product-anchor">
                        <div class="row">
                          <div class="prod-image-wrapper">
                            <img src="images/products/{{ $cate_product->images[0]->image_name }}" alt="">
                          </div>
                        </div>
                        <div class="row collapse">
                          <div class="prod-title">
                              <p class="tight title">{{ $cate_product->product_name }}</p>
                              <p class="micro tight">this is a description</p>
                          </div> 
                          <div class="prod-det">
                            <div class="small-12 columns">
                              <p class="tight prod-mrp tiny">
                                @if (($cate_product->mrp->mrp) > 0)
                                  MRP Rs.{{ $cate_product->mrp->mrp }}/
                                  @if( $cate_product->mrp->qty > 1 )
                                    {{ $cate_product->mrp->qty }}
                                  @endif
                                  {{ $cate_product->mrp->unit->shortform }}
                                @endif
                              </p>
                            </div>
                            <!-- <div class="small-12 columns">
                              <p class="tight prod-our-price ">
                                {{--*/ 
                                  $sorted_products = $cate_product->prices->sortBy('price');
                                  $lowest_product = $sorted_products->first();
                                  /*--}}
                                Rs.{{ $lowest_product->price }} / 
                                  <span class="qty-fix">
                                    @if($lowest_product->qty > 1 )
                                    {{ $lowest_product->qty }}
                                    @endif
                                    {{ $lowest_product->unit->shortform }}
                                    
                                  </span>
                              </p>
                            </div> -->
                          </div>
                        </div>
                      </a>
                      <div class="row">
                        <div class="quantity-wrapper">
                          <div class="small-12 columns">
                            <div class="row collapse">
                              <div class="small-3 columns">
                                <label class="prefix">Qty</label>
                              </div>
                              <div class="small-9 columns">
                                <select name="" id="" class="quantity-price">
                                  @foreach ($cate_product->prices->sortBy('price') as $price)
                                      <option data-price-id="{{ $price->id }}" data-price="{{ $price->price }}" value="">{{ $price->qty }}{{ $price->unit->shortform }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="small-12 columns">
                            <div class="row collapse qty-price-wrapper">
                              <div class="small-7 columns">
                                <p class="tight qty-price">
                                  Rs. <span class="price-num"></span>
                                </p>
                              </div>
                              <div class="small-5 columns">
                                <p class="text-right tight">
                                  <button data-pid="{{ $cate_product->id }}" data-price-id="" class="button success tiny ATC">Add <i class="fi-shopping-cart"></i></button>
                                </p>
                              </div>
                            </div>
                          </div>
                      </div>
                      </div>
                    </div>
                  </div>
                @endforeach


      
              </div>
            @endif
           
        </div>
      
      <!-- <div class="row">
        <div class="medium-12 columns">
          <div class="similar-products-wrapper">
            <h3>Other Brands</h3>
          </div>
        </div>
      </div> -->
    </div>
  </div>
</div>

@include('site.partials.footer_top')
@include('site.partials.footer_middle') 
@stop

@section('page-modal')

@stop

@section('scriptsContent')
  <script type="text/javascript" src="js/site/product-view.js"></script>
  <script type="text/javascript">
  //change the price based on quantity select
   $(".quantity-price").on('change', function(){
    var opt = $(this).find('option:selected');
    var price = opt.data('qprice');
    var pid = opt.data('pid');
    var clo = $(this).parents('.quantity-wrapper').find('.qty-price');
    var buybtn = $(this).parents('.quantity-wrapper').find('button.ATC');
    buybtn.data('pid', pid); //change buy button id to selected quantity
    clo.html('<span class="price-num">&#8377;'+ price+'</span>')
    console.log('changed');
   });
   //$(".quantity-price").trigger('change');


   //product-image slider

    $( '#product-image-slider' ).sliderPro();


  </script>
@stop