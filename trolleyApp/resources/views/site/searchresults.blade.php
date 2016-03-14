
@extends ('site/master')

@section ('content')
@include('site.partials.header_top')
@include('site.partials.header_middle')
<div class="full-width content-top veg">
  <div class="row collapse">
    <div class="small-3 columns">
      @include('site.partials.side_cate')
    </div>
    <div class="small-9 columns">
      <div class="product-grid-1">
          @if(count($search_products) > 0)
            <div class="row caro-title collapse">
              <div class="small-12 columns">
                <h5 class="tight"><span class="inner-text">Search Results {{$key}}</span></h5>
              </div>
            </div>
            <div class="row">
              @foreach ( $search_products as $search_product)
                <div class="small-3 end columns">
                  <div class="product-wrapper">
                    <a href="product/{{ $search_product->id }}" class="product-anchor">
                      <div class="row">
                        <div class="prod-image-wrapper">
                          <div class="save-wrapper">                              
                              SAVE <br><span class="save"></span>%
                          </div>
                          <img src="images/img_loader/loader.gif" data-echo="images/products/{{ $search_product->images[0]->image_name }}" alt="">
                        </div>
                      </div>
                      <div class="row collapse">
                        <div class="prod-title">
                            <p class="tight title">{!! substr($search_product->product_name, 0, 32) !!}</p>
                        </div> 
                        <div class="prod-det">
                          <div class="small-12 columns">
                            <p class="tight prod-mrp tiny">
                              @if(count($search_product->mrps) > 0)
                                @foreach($search_product->mrps as $mrp)
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
                                @foreach ($search_product->prices->sortBy('price') as $price)
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
                                <button data-pid="{{ $search_product->id }}" data-price-id="" class="button success tiny ATC">Add <i class="fi-shopping-cart"></i></button>
                              </p>
                            </div>
                          </div>
                        </div>
                    </div>
                    </div>
                  </div>
                </div>
              @endforeach


    <!--           @if (count($search_products) < 1)
                <p>Sorry, No Products in {{ $main_category->category_name }}</p>
              @endif -->
            </div>
          @endif
          
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