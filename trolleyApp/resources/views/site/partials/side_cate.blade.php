<ul class="side-menu">
  <h5 class="highlight no-margin lshadow"><i class="fi-list"></i> CATEGORIES</h5>
  @foreach ($categories as $category)
    <li class="has-child">
      <a href="category/{{ $category->category_name }}">{{ $category->category_name }}</a>
      <ul class="submenu">
      @foreach($category->children as $child)
		<li>
			<a href="category/{{ $child->category_name }}">{{$child->category_name}}</a>
		</li>
      @endforeach
      </ul>
    </li>
  @endforeach

</ul>