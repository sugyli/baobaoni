@if ($weekdates->count() > 0)
  <div class="tuijian re f-cb Displayanimation">
    <div class="title">
      会员周推荐
    </div>

    <div class="tuijian-cove">
      @foreach ($weekdates as $weekdate)
          <a href="{{$weekdate->relationArticles->link()}}">
            <img src="{{$weekdate->relationArticles->imgflag}}" alt="{{$weekdate->relationArticles->articlename}}" />
            <span class="note_adds">
              <em class="note_bg"></em>
              <em class="note_name">{{$weekdate->relationArticles->articlename}}</em>
              <em class="note_text">作者:{{$weekdate->relationArticles->author}}</em>
            </span>

            <div class="info">
              {{ str_limit($weekdate->relationArticles->intro, 200) }}
            </div>
          </a>
          @break($loop->first)
      @endforeach
    </div>

    <ul>
      @foreach ($weekdates as $weekdate)
        @continue($loop->first)
        <li>
          <span>{{$weekdate->relationArticles->author}}</span>
          <a href="{{$weekdate->relationArticles->link()}}" title="{{$weekdate->relationArticles->articlename}}">{{$weekdate->relationArticles->articlename}}</a>
        </li>
      @endforeach
    </ul>
  </div>
  @endif
