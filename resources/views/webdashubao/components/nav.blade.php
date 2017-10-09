<nav class="main re nav f-cb">
    <ul>
      <li><a href="/">首页</a></li>
      @if($sorts = get_sort('webnovel'))
      @foreach($sorts as $sort)
      <li><a href="{{$sort['uri']}}">{{$sort['title']}}</a></li>
       @break($loop->iteration == 11)
      @endforeach
      @endif
    </ul>
</nav>
