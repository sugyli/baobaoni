@if ($weekdates->count() > 0)
<section class="i-cl">
  <div class="i-cl-header">
    <p class="i-cl-header-title">
      会员推荐<i>周榜</i>
    </p>
  </div>
  <ul class="i-cl-list Displayanimation">
    @foreach ($weekdates as $weekdate)
    <li>
      <div class="i-cl-list-main">
        <a href="{{$weekdate->relationArticles->link()}}">
          <div class="i-cl-list-main-left">
            <img src="{{$weekdate->relationArticles->imgflag}}"/>
            <p class="i-cl-list-main-left-state">
              {{$weekdate->relationArticles->fullflag}}
            </p>
          </div>
          <div class="i-cl-list-main-right">
            <p class="i-cl-list-main-right-bookname">
              {{$weekdate->relationArticles->articlename}}
            </p>

            <p class="i-cl-list-main-right-author">
              {{$weekdate->relationArticles->author}}
            </p>

            <p class="i-cl-list-main-right-info">
              {{ str_limit($weekdate->relationArticles->intro, 200) }}
            </p>
            <div class="i-cl-list-main-right-tags">
              <div class="i-cl-list-main-right-tags-tag">{{$weekdate->relationArticles->getSort()['title'] or '未知分类'}}</div>
            </div>

          </div>
        </a>
      </div>
    </li>
    @break($loop->iteration >= 5)
    @endforeach

  </ul>
</section>
@endif
