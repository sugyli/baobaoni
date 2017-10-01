@if ($monthdates->count() > 0)
  <div class="tuijian re f-cb Displayanimation">
    <div class="title">
      会员月推荐
    </div>

    <div class="tuijian-cove">
      @foreach ($monthdates as $monthdate)
          <a href="{{$monthdate->relationArticles->link()}}">
            <img src="{{$monthdate->relationArticles->imgflag}}" alt="{{$monthdate->relationArticles->articlename}}" />
            <span class="note_adds">
              <em class="note_bg"></em>
              <em class="note_name">{{$monthdate->relationArticles->articlename}}</em>
              <em class="note_text">作者:{{$monthdate->relationArticles->author}}</em>
            </span>
            <div class="info">
              {{ str_limit($monthdate->relationArticles->intro, 200) }}
            </div>
          </a>
          @break($loop->first)
      @endforeach
    </div>

    <ul>
      @foreach ($monthdates as $monthdate)
        @continue($loop->first)
        <li>
          <span>{{$monthdate->relationArticles->author}}</span>
          <a href="{{$monthdate->relationArticles->link()}}" title="{{$monthdate->relationArticles->articlename}}">{{$monthdate->relationArticles->articlename}}</a>
        </li>
      @endforeach
    </ul>
  </div>
  @endif
