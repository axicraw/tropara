<ul class="side-menu">
  <h5 class="highlight no-margin lshadow"><i class="fi-list"></i> CATEGORIES</h5>
  @foreach ($categories as $category)
    @if(count($category->children) > 0)
      <li class="has-child">
        <a href="category/{{$category->category_name}}">{{ $category->category_name }} </a>
        <div class="sublevel">
          <ul class="sublists">
            @foreach($category->children as $child)
              @if(count($child->children) > 0)
              <li class="has-child">
                <a href="category/{{ $child->category_name }}">{{$child->category_name}} ({{count($child->products)}})</a>
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
        <ul class="submenu" style="display: none;">
        @foreach($category->children as $child)
          @if(count($child->children) > 0)
          <li class="has-child">
            <a href="category/{{ $child->category_name }}">{{$child->category_name}} ({{count($child->products)}})</a>
              <ul class="submenu level2">
                @foreach($child->children as $gc)
                  <li>
                    <a href="category/{{ $gc->category_name }}">{{ $gc->category_name }} ({{count($gc->products)}})</a>
                  </li>
                @endforeach
              </ul>
          </li>
          @else
            <li>
              <a href="category/{{ $child->category_name }}">{{ $child->category_name }} ({{count($child->products)}})</a>
            </li>
          @endif
        @endforeach
        </ul>
      </li>
    @else
      <li>
        <a href="category/{{ $category->category_name }}">{{ $category->category_name }} ({{count($category->products)}})</a>
      </li>

    @endif
    
  @endforeach

</ul>
