<ul class="side-menu">
  <h5 class="highlight no-margin lshadow"><i class="fi-list"></i> CATEGORIES</h5>
  {{--*/ 
    $categories = $categories->sortBy('did');
  /*--}}
  @foreach ($categories as $category)
    @if(count($category->children) > 0)
      <li class="has-child">
        <a href="category/{{$category->category_name}}">{{ $category->category_name }} </a>
        <div class="sublevel">
          <ul class="sublists">
            @foreach($category->children->sortBy('did') as $child)
              @if(count($child->children) > 0)
              <li class="has-child">
                <a href="category/{{ $child->category_name }}">{{$child->category_name}} </a>
                  <div class="sublevel2">
                    <ul class="sublists">
                      @foreach($child->children as $gc)
                        <li>
                          <a href="category/{{ $gc->category_name }}">{{ $gc->category_name }} 
                            @if(count($gc->products) > 0)
                               ({{count($gc->products)}})
                            @endif
                          </a>
                        </li>
                      @endforeach
                    </ul>
                  </div>
              </li>
              @else
                <li>
                  <a href="category/{{ $child->category_name }}">{{ $child->category_name }} 
                    @if(count($child->products) > 0)
                        ({{count($child->products)}})
                    @endif
                  </a>
                </li>
              @endif
            @endforeach
          </ul>
        </div>
      </li>
    @else
      <li>
        <a href="category/{{ $category->category_name }}">{{ $category->category_name }} 
          @if(count($category->products) > 0)
              ({{count($category->products)}})
          @endif
        </a>
      </li>

    @endif
    
  @endforeach

</ul>
