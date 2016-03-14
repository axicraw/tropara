
@extends ('site/master')

@section ('content')
@include('site.partials.header_top')
@include('site.partials.header_middle')
<div class="full-width content-top veg">
  <div class="row collapse">
    <div class="small-3 columns">
      <div class="row">
        <ul class="side-menu">
        
            <h5 class="highlight no-margin lshadow">
              <a class="cate-drop" href=""><i class="fi-list"></i> <span>categories</span></a>  - 
              <span class="sub-heading">
                @foreach ( $categories as $category )
                  @if($category->id === $main_category->parent_id)
                    {{$category->category_name}}
                  @endif
                @endforeach
              </span>
            </h5>
            @if($parent_category != null)
              @foreach ($parent_category->children as $child_cate)
                  <li>
                    <a href="category/{{ $child_cate->category_name }}">{{$child_cate->category_name}}</a>

                  </li>              
              @endforeach

            @else
              @foreach ($categories as $category)
                @if(count($category->children) > 0)
                  <li class="has-child">
                    {{ $category->category_name }}
                    <ul class="submenu">
                    @foreach($category->children as $child)
                      <li>
                        <a href="category/{{ $child->category_name }}">{{$child->category_name}}
                        ({{count($child->products)}})</a>
                      </li>
                    @endforeach
                    </ul>
                  </li>
                @else
                  <li>
                    <a href="category/{{ $category->category_name }}">{{ $category->category_name }}
                    ({{count($category->products)}})</a>
                  </li>

                @endif
                
              @endforeach
            @endif
        </ul>
      </div>
    </div>
    <div class="small-9 columns">
      <div class="product-grid-1">
          @if(count($cate_products) > 0)
            <div class="row caro-title collapse">
              <div class="small-12 columns">
                <h5 class="tight"><span class="inner-text">In {{$main_category->category_name}}</span></h5>
              </div>
            </div>
            <div class="row">
              @foreach ( $cate_products as $cate_product)
                <div class="small-3 end columns">
                  <div class="product-wrapper">
                    <a href="product/{{ $cate_product->id }}" class="product-anchor">
                      <div class="row">
                        <div class="prod-image-wrapper">
                          <div class="save-wrapper">                              
                              SAVE <br><span class="save"></span>%
                            </div>
                          <img src="images/img_loader/loader.gif" data-echo="images/products/{{ $cate_product->images[0]->image_name }}" alt="">
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


    <!--           @if (count($cate_products) < 1)
                <p>Sorry, No Products in {{ $main_category->category_name }}</p>
              @endif -->
            </div>
          @endif
          @if(count($sub_products) > 0)
            <div class="row">
              <h5>In {{$main_category->category_name}}</h5>
              @foreach ( $sub_products as $sub_product)
                <div class="small-3 end columns">
                  <div class="product-wrapper">
                    <a href="product/{{ $sub_product->id }}" class="product-anchor">
                      <div class="row">
                        <div class="prod-image-wrapper">
                          <img src="images/img_loader/loader.gif" data-echo="images/products/{{ $sub_product->images[0]->image_name }}" alt="">
                        </div>
                      </div>
                      <div class="row collapse">
                        <div class="prod-title">
                            <p class="tight title">{{ $sub_product->product_name }}</p>
                            <p class="micro tight">this is a description</p>
                        </div> 
                        <div class="prod-det">
                          <div class="small-12 columns">
                            <p class="tight prod-mrp tiny">
                              @if (($sub_product->mrp->mrp) > 0)
                                MRP Rs.{{ $sub_product->mrp->mrp }}/
                                @if( $sub_product->mrp->qty > 1 )
                                  {{ $sub_product->mrp->qty }}
                                @endif
                                {{ $sub_product->mrp->unit->shortform }}
                              @else
                                &nbsp;
                              @endif
                            </p>
                          </div>
                          <div class="small-12 columns">
                            <p class="tight prod-our-price ">
                              {{--*/ 
                                $sorted_products = $sub_product->prices->sortBy('price');
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
                                @foreach ($sub_product->prices->sortBy('price') as $price)
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
                                <button data-pid="{{ $sub_product->id }}" data-price-id="" class="button success tiny ATC">Add <i class="fi-shopping-cart"></i></button>
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