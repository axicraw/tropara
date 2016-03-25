    <div class="full-width weekly-offers">
      <div class="row caro-title collapse">
        <div class="small-12 columns">
          <h4 class="tight"><span class="inner-text">Weekly Offers</span></h4>
        </div>
      </div>
      <div class="row caro-offer-wrapper">

          @if(count($offers) > 0)
            {{--*/ $limit=10; $id=0; /*--}}
            @foreach($offers as $offer)
              
              @if(count($offer->products) > 0)
                @foreach($offer->products as $product)
                  @if($id < $limit)
                    {{--*/ $id++; /*--}}
                    <div class="small-6 medium-4 columns end hide-for-large-up">
                      <div class="caro-prod">
                        <a href="/product/{{$product->product_name}}?id={{$product->id}}">
                          <div class="img-wrapper prod-img">
                            <p class="tight text-center">
                              <img src="images/img_loader/loader.gif" data-echo="images/products/{{$product->images[0]['image_name']}}" alt="{{$product->product_name}}">
                            </p>
                          </div>
                          
                          <p class="prod-title text-center tight">
                            {{$product->product_name}} 
                            <span class="label alert">
                              {{$offer->amount}}
                              @if($offer->offer_type === 1)
                                %
                              @else
                                <i class="fa fa-rupee"></i>
                              @endif
                              Off
                            </span>
                          </p>
                        </a>
                        <!-- <div class="prod-det">
                          <div class="row">
                            <div class="small-6 columns">

                              <p class="prod-price tight"><i class="fa fa-rupee"></i> 20</p>
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
                        </div> -->
                      </div>
                    </div>
                    <div class="show-for-large-up col5-unit columns end">
                      <div class="caro-prod">
                        <a href="/product/{{$product->product_name}}?id={{$product->id}}">
                          <div class="img-wrapper prod-img">
                            <p class="tight text-center">
                              <img src="images/img_loader/loader.gif" data-echo="images/products/{{$product->images[0]['image_name']}}" alt="{{$product->product_name}}">
                            </p>
                          </div>
                          
                          <p class="prod-title text-center tight">
                            {{$product->product_name}} 
                            <span class="label alert">
                              {{$offer->amount}}
                              @if($offer->offer_type === 1)
                                %
                              @else
                                <i class="fa fa-rupee"></i>
                              @endif
                              Off
                            </span>
                          </p>
                        </a>
                        <!-- <div class="prod-det">
                          <div class="row">
                            <div class="small-6 columns">

                              <p class="prod-price tight"><i class="fa fa-rupee"></i> 20</p>
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
                        </div> -->
                      </div>
                    </div>
                  @endif
                @endforeach
              @endif
              @if(count($offer->categories) > 0)
                @foreach($offer->categories as $category) 
                  @if(count($category->products) > 0)
                    @foreach($category->products as $product)
                      @if($id < $limit)
                        {{--*/ $id++; /*--}}
                        <div class="small-6 medium-4 columns hide-for-large-up end">
                          <div class="caro-prod">
                            <a href="/product/{{$product->product_name}}?id={{$product->id}}">
                              <div class="img-wrapper prod-img">
                                <p class="tight text-center">
                                  <img src="images/img_loader/loader.gif" data-echo="images/products/{{$product->images[0]['image_name']}}" alt="{{$product->product_name}}">
                                </p>
                              </div>
                              
                              <p class="prod-title text-center tight">
                                {{$product->product_name}} 
                                <span class="label alert">
                                  {{$offer->amount}}
                                  @if($offer->offer_type === 1)
                                    %
                                  @else
                                    <i class="fa fa-rupee"></i>
                                  @endif
                                  Off
                                </span>
                              </p>
                            </a>
                            <!-- <div class="prod-det">
                              <div class="row">
                                <div class="small-6 columns">

                                  <p class="prod-price tight"><i class="fa fa-rupee"></i> 20</p>
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
                            </div> -->
                          </div>
                        </div>
                        <div class="show-for-large-up col5-unit columns end">
                          <div class="caro-prod">
                            <a href="/product/{{$product->product_name}}?id={{$product->id}}">
                              <div class="img-wrapper prod-img">
                                <p class="tight text-center">
                                  <img src="images/img_loader/loader.gif" data-echo="images/products/{{$product->images[0]['image_name']}}" alt="{{$product->product_name}}">
                                </p>
                              </div>
                              
                              <p class="prod-title text-center tight">
                                {{$product->product_name}} 
                                <span class="label alert">
                                  {{$offer->amount}}
                                  @if($offer->offer_type === 1)
                                    %
                                  @else
                                    <i class="fa fa-rupee"></i>
                                  @endif
                                  Off
                                </span>
                              </p>
                            </a>
                            <!-- <div class="prod-det">
                              <div class="row">
                                <div class="small-6 columns">

                                  <p class="prod-price tight"><i class="fa fa-rupee"></i> 20</p>
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
                            </div> -->
                          </div>
                        </div>
                      @endif
                    @endforeach
                  @endif
                @endforeach
              @endif
              @if(count($offer->brands) > 0)
                @foreach($offer->brands as $category) 
                  @if(count($category->products) > 0)
                    @foreach($category->products as $product)
                      @if($id < $limit)
                        {{--*/ $id++; /*--}}
                        <div class="small-6 medium-4 columns hide-for-large-up end">
                          <div class="caro-prod">
                            <a href="/product/{{$product->product_name}}?id={{$product->id}}">
                              <div class="img-wrapper prod-img">
                                <p class="tight text-center">
                                  <img src="images/img_loader/loader.gif" data-echo="images/products/{{$product->images[0]['image_name']}}" alt="{{$product->product_name}}">
                                </p>
                              </div>
                              
                              <p class="prod-title text-center tight">
                                {{$product->product_name}} 
                                <span class="label alert">
                                  {{$offer->amount}}
                                  @if($offer->offer_type === 1)
                                    %
                                  @else
                                    <i class="fa fa-rupee"></i>
                                  @endif
                                  Off
                                </span>
                              </p>
                            </a>
                            <!-- <div class="prod-det">
                              <div class="row">
                                <div class="small-6 columns">

                                  <p class="prod-price tight"><i class="fa fa-rupee"></i> 20</p>
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
                            </div> -->
                          </div>
                        </div>
                        <div class="show-for-large-up col5-unit columns end">
                          <div class="caro-prod">
                            <a href="/product/{{$product->product_name}}?id={{$product->id}}">
                              <div class="img-wrapper prod-img">
                                <p class="tight text-center">
                                  <img src="images/img_loader/loader.gif" data-echo="images/products/{{$product->images[0]['image_name']}}" alt="{{$product->product_name}}">
                                </p>
                              </div>
                              
                              <p class="prod-title text-center tight">
                                {{$product->product_name}} 
                                <span class="label alert">
                                  {{$offer->amount}}
                                  @if($offer->offer_type === 1)
                                    %
                                  @else
                                    <i class="fa fa-rupee"></i>
                                  @endif
                                  Off
                                </span>
                              </p>
                            </a>
                            <!-- <div class="prod-det">
                              <div class="row">
                                <div class="small-6 columns">

                                  <p class="prod-price tight"><i class="fa fa-rupee"></i> 20</p>
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
                            </div> -->
                          </div>
                        </div>
                      @endif
                    @endforeach
                  @endif
                @endforeach
              @endif
            @endforeach

          @endif
        </div>
      </div>
    </div>
    <div class="full-width footer-top">
      <div class="row">
        <div class="small-12 medium-6 large-4 columns">

          <div class="row left-section">
           <div class="small-12 columns">
              <h4 class="section-title tight">Recently Viewed</h4>
             <div class="recent-slider">
              @if(isset($viewpros))
                @if(count($viewpros) > 0)
                  @foreach($viewpros as $viewpro)
                    <div class="recent-slide">
                      <a href="/product/{{$viewpro->product_name}}?id={{$viewpro->id}}">
                          <div class="img-wrapper">
                            <img src="images/products/{{$viewpro->images[0]['image_name']}}" alt="{{$viewpro->product_name}}">
                          </div>
                          <p class="side-offer-product tight text-center">{{$viewpro->product_name}}</p>
                      </a>
                    </div>
                  @endforeach
                @endif
              @endif
             </div>
           </div>
          </div>
        </div>
        <div class="large-4 show-for-large-up columns">
          <div class="row middle-section">
            <div class="small-12 columns">
              <h4 class="section-title tight">
                Customer Talk
              </h4>
              <div class="customer-talk">
                <div class="talks-slider">
                 @if(isset($feedbacks))
                   @if(count($feedbacks) > 0)
                     @foreach($feedbacks as $feedback)
                       <div class="talks-slide">
                         <p>
                          <br>
                           <strong>{{$feedback->user->name}}</strong> says:
                           <blockquote>{!! substr($feedback->feedback, 0, 20)  !!}...</blockquote>
                         </p>
                       </div>
                     @endforeach
                   @endif
                 @endif
                </div>
              </div>
            </div>
          </div>
          <div class="row middle-section">
            <div class="small-12 columns">
              <h4 class="section-title tight">
                Success Recipies
              </h4>
              <div class="section-body">
                <p class="tight text-center">Ever wanted to be a cooking maestro</p>
                <h4 class="text-center">Coming Soon.</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="small-12 medium-6 large-4 clearfix columns">
          <div class="row right-section">
           <div class="small-12 columns">
              <h4 class="section-title tight">Hot Selling</h4>
             <div class="recent-slider">
              @if(isset($hotpros))
                @if(count($hotpros) > 0)
                  @foreach($hotpros as $hotpro)
                    <a href="/product/{{$hotpro->product_name}}?id={{$hotpro->id}}">
                      <div class="recent-slide">
                        <div class="img-wrapper">
                          <img src="images/products/{{$hotpro->images[0]['image_name']}}" alt="{{$hotpro->product_name}}">
                        </div>
                        <p class="side-offer-product tight text-center">{{$hotpro->product_name}}</p>
                      </div>
                    </a>
                  @endforeach
                @endif
              @endif
             </div>
           </div>
          </div>
        </div>
      </div>

    </div>

