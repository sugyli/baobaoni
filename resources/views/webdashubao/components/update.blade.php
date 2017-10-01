@if ($updataBooks->count() > 0)
<div class="update Displayanimation">
  <div class="title">
    {{ $updateTitle or '最新更新' }}
  </div>
  <div class="f-cb">
    @foreach ($updataBooks as $updataBook)
    <dl>
      <a href="{{$updataBook->link()}}">
        <dt>
          <img src="{{ $updataBook->imgflag }}" alt="{{$updataBook->articlename}}">
          <p>
            {{ $updataBook->fullflag }}
          </p>
          <div class="book-h5__order">{{$loop->iteration}}</div>
        </dt>
        <dd>
          <h3>{{$updataBook->articlename}}</h3>
          <span>{{$updataBook->author}}</span>
          <p>{{ str_limit($updataBook->intro, 200) }}</p>
        </dd>
      </a>
    </dl>
      @break($loop->iteration >= 3)
    @endforeach

  </div>

  <ul>
    @foreach ($updataBooks as $updataBook)
      @continue($loop->iteration <=3)
      <li>
        <div class="update-list">
          <span class="nb">{{$loop->iteration}}</span>
          <span class="sm"><a href="{{ $updataBook->link() }}">{{$updataBook->articlename}}</a></span>
          <span class="zj"><a href="{{route('articles.show', ['bid' => $updataBook->articleid , 'cid' => $updataBook->lastchapterid])}}">{{$updataBook->lastchapter}}</a></span>
          <span class="zz">{{$updataBook->author}}</span>
          <span class="sj">{{$updataBook->lastupdatef}}</span>
        </div>
      </li>
    @endforeach

</div>
@endif
