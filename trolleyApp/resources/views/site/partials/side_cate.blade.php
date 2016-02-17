<ul class="side-menu">
  <h5 class="highlight no-margin lshadow"><i class="fi-list"></i> CATEGORIES</h5>
  @foreach ($categories as $category)
    @if(count($category->children) > 0)
      <li class="has-child">
        {{ $category->category_name }}
        <ul class="submenu">
        @foreach($category->children as $child)
          <li>
            <a href="category/{{ $child->category_name }}">{{$child->category_name}}</a>
          </li>
        @endforeach
        </ul>
      </li>
    @else
      <li>
        <a href="category/{{ $category->category_name }}">{{ $category->category_name }}</a>
      </li>

    @endif
    
  @endforeach

</ul>