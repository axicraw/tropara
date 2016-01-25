    <div class="full-width weekly-offers">
      <div class="row caro-title collapse">
        <div class="small-12 columns">
          <h4 class="tight"><span class="inner-text">Weekly Offers</span></h4>
        </div>
      </div>
      <div class="row caro-offer-wrapper">

          @if(count($offers) > 0)
            @foreach($offers as $offer)
              
              @foreach($offer->products as $product)
                <div class="col5-unit columns">
                            <div class="caro-prod">
                              <a href="/product/{{$product->id}}">
                                <div class="img-wrapper prod-img">
                                  <p class="tight text-center">
                                    <img src="images/products/{{$product->images[0]['image_name']}}" alt="product-image">
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
              @endforeach
            @endforeach

          @endif
        </div>
      </div>
    </div>
    <div class="full-width footer-top">
      <div class="row">
        <div class="small-4 columns">

          <div class="row left-section">
           <div class="small-12 columns">
              <h4 class="section-title tight">Recently Viewed</h4>
             <div class="recent-slider">
              @if(isset($viewpros))
                @if(count($viewpros) > 0)
                  @foreach($viewpros as $viewpro)
                    <div class="recent-slide">
                      <div class="img-wrapper">
                        <img src="images/products/{{$viewpro->images[0]['image_name']}}" alt="">
                      </div>
                      <p class="side-offer-product tight text-center">{{$viewpro->product_name}}</p>
                    </div>
                  @endforeach
                @endif
              @endif
             </div>
           </div>
          </div>
        </div>
        <div class="small-4 columns">
          <div class="row middle-section">
            <div class="small-12 columns">
              <h4 class="section-title tight">
                Success Recipies
              </h4>
              <div class="section-body">
                <p class="tight text-center">Ever wanted to be a cooking maestro</p>
                <h4 class="text-center">Read Success Recipes <br> and Stories</h4>
              </div>
            </div>


          </div>
        </div>
        <div class="small-4 columns">
          <div class="row right-section">
           <div class="small-12 columns">
              <h4 class="section-title tight">Hot Selling</h4>
             <div class="recent-slider">
              @if(isset($hotpros))
                @if(count($hotpros) > 0)
                  @foreach($hotpros as $hotpro)
                    <div class="recent-slide">
                      <div class="img-wrapper">
                        <img src="images/products/{{$hotpro->images[0]['image_name']}}" alt="">
                      </div>
                      <p class="side-offer-product tight text-center">{{$hotpro->product_name}}</p>
                    </div>
                  @endforeach
                @endif
              @endif
             </div>
           </div>
          </div>
        </div>
      </div>
    </div>