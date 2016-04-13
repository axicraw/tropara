
@extends ('site/master')

@section ('content')
@include('site.partials.header_top')
@include('site.partials.header_middle')
<div class="full-width content-top veg">
  <div class="row collapse">
    <div class="large-3 columns show-for-large-up">
      @include('site.partials.side_cate')
    </div>
    <div class="large-9 medium-12 columns">
      <div class="product-grid-1">
        <div class="row caro-title collapse">
          <div class="small-12 columns">
            <h1 class="tight main-page-title"><span class="inner-text">In {{$main_category->category_name}}</span></h1>
          </div>
        </div>

        <div class="row">
          @if(count($cate_products) > 0)

              @foreach ( $cate_products as $cate_product)
                <div class="small-6 medium-4 large-3 end columns">
                  <div class="product-wrapper">
                    <a href="product/{{$cate_product->product_name}}?id={{ $cate_product->id }}" class="product-anchor">
                      <div class="row">
                        <div class="prod-image-wrapper">
                          <div class="save-wrapper">                              
                              SAVE <br><span class="save"></span>%
                            </div>
                          <img src="images/img_loader/loader.gif" data-echo="images/products/{{ $cate_product->images[0]->image_name }}" alt="{{$cate_product->product_name}}">
                        </div>
                      </div>
                      <div class="row collapse">
                        <div class="prod-title">
                            <p class="tight title">{!! substr($cate_product->product_name, 0, 32) !!}</p>
                        </div> 
                        <div class="prod-det">
                           <div class="small-12 columns">
                              <p class="tight prod-mrp tiny">
                                @if(count($cate_product->mrps) > 0)
                                  @foreach($cate_product->mrps as $mrp)
                                    <span class="mrp-wrapper" data-mrp="{{$mrp->mrp}}" data-qty="{{$mrp->qty}}" data-unit="{{$mrp->unit->shortform}}">
                                    MRP : Rs. 
                                    {{$mrp->mrp}}/{{$mrp->qty}}{{$mrp->unit->shortform}}</span>
                                  @endforeach
                                @else
                                  &nbsp;
                                @endif
                              </p>
                            </div>
                          
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
                                    <option data-price-id="{{ $price->id }}" data-price="{{ $price->price }}" data-unit="{{$price->unit->shortform}}" data-qty="{{$price->qty}}" value="">{{ $price->qty }}{{ $price->unit->shortform }}</option>
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
                                @if($cate_product->out_of_stock)
                                  <span class="danger micro">Out of stock</span>
                                @else
                                  <button data-pid="{{ $cate_product->id }}" data-pname="{{$cate_product->product_name}}" data-price-id="" class="button success tiny ATC">Add <i class="fi-shopping-cart"></i></button>
                                @endif
                              </p>
                            </div>
                          </div>
                        </div>
                    </div>
                    </div>
                  </div>
                </div>
              @endforeach


    <!--           @if (count($cate_products) < 1)
                <p>Sorry, No Products in {{ $main_category->category_name }}</p>
              @endif -->
            
          @endif
          @if(count($sub_products) > 0)
              @foreach ( $sub_products as $cate_product)
                <div class="small-6 medium-4 large-3 end columns">
                  <div class="product-wrapper">
                    <a href="product/{{$cate_product->product_name}}?id={{ $cate_product->id }}" class="product-anchor">
                      <div class="row">
                        <div class="prod-image-wrapper">
                          <div class="save-wrapper">                              
                              SAVE <br><span class="save"></span>%
                            </div>
                          <img src="images/img_loader/loader.gif" data-echo="images/products/{{ $cate_product->images[0]->image_name }}" alt="{{$cate_product->product_name}}">
                        </div>
                      </div>
                      <div class="row collapse">
                        <div class="prod-title">
                            <p class="tight title">{!! substr($cate_product->product_name, 0, 32) !!}</p>
                        </div> 
                        <div class="prod-det">
                           <div class="small-12 columns">
                              <p class="tight prod-mrp tiny">
                                @if(count($cate_product->mrps) > 0)
                                  @foreach($cate_product->mrps as $mrp)
                                    <span class="mrp-wrapper" data-mrp="{{$mrp->mrp}}" data-qty="{{$mrp->qty}}" data-unit="{{$mrp->unit->shortform}}">
                                    MRP : Rs. 
                                    {{$mrp->mrp}}/{{$mrp->qty}}{{$mrp->unit->shortform}}</span>
                                  @endforeach
                                @else
                                  &nbsp;
                                @endif
                              </p>
                            </div>
                          
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
                                    <option data-price-id="{{ $price->id }}" data-price="{{ $price->price }}" data-unit="{{$price->unit->shortform}}" data-qty="{{$price->qty}}" value="">{{ $price->qty }}{{ $price->unit->shortform }}</option>
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
                                @if($cate_product->out_of_stock)
                                  <span class="danger">Out of stock</span>
                                @else
                                  <button data-pid="{{ $cate_product->id }}" data-pname="{{$cate_product->product_name}}" data-price-id="" class="button success tiny ATC">Add <i class="fi-shopping-cart"></i></button>
                                @endif
                              </p>
                            </div>
                          </div>
                        </div>
                    </div>
                    </div>
                  </div>
                </div>
              @endforeach
          @endif

          @if(count($cate_products) < 1 && count($sub_products) < 1)
            <p class="text-center">No products available right now in this category.</p>
          @endif
        </div>
      </div>
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
    $('.offer-slider').slick({
      vertical: true,
      verticalSwiping: true,
      autoplay:true,
      arrows:false,
      rows:2,

    });
    $('.recent-slider').slick({
      vertical: false,
      autoplay:true,
      rows:2,
      slidesPerRow:2,
      arrows:false,
    });
    
  </script>
@stop