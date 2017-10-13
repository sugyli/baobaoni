@if ($monthdates->count() > 0)
<section class="i-cl">
  <div class="i-cl-header">
    <p class="i-cl-header-title">
      会员推荐<i>月榜</i>
    </p>
  </div>
  <ul class="i-cl-list Displayanimation">
    @foreach ($monthdates as $monthdate)
    <li>
      <div class="i-cl-list-main">
        <a href="{{$monthdate->relationArticles->link()}}">
          <div class="i-cl-list-main-left">
            <img src="{{$monthdate->relationArticles->imgflag}}"/>
            <p class="i-cl-list-main-left-state">
              {{$monthdate->relationArticles->fullflag}}
            </p>
          </div>
          <div class="i-cl-list-main-right">
            <p class="i-cl-list-main-right-bookname">
              {{$monthdate->relationArticles->articlename}}
            </p>

            <p class="i-cl-list-main-right-author">
              {{$monthdate->relationArticles->author}}
            </p>

            <p class="i-cl-list-main-right-info">
              {{ str_limit($monthdate->relationArticles->intro, 200) }}
            </p>
            <div class="i-cl-list-main-right-tags">
              <div class="i-cl-list-main-right-tags-tag">{{$monthdate->relationArticles->getSort()['title'] or '未知分类'}}</div>
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
