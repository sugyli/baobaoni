@extends('weixin.layouts.default')
@section('title'){{config('app.weixin_name')}}-{{config('app.url_weixin')}}@endsection

@section('content')
@include('weixin.include.header')
<div class="content">
    @include('weixin.include.search')
    <div class="module mt10">
       <div class="module-hd"><h2>编辑推荐</h2></div>

       <ul class="clearfix bookimglist">
         @if ($weixinTuijianDatas->count() > 0)
         @foreach ($weixinTuijianDatas as $weixinTuijianData)
          <li>
              <a href="{{$weixinTuijianData->weixinlink}}">
                  <img src="{{ $weixinTuijianData->imgflag}}" alt="{{$weixinTuijianData->articlename}}" class="pic" />
                  <p class="name">{{$weixinTuijianData->articlename}}</p>
              </a>
          </li>
          @break($loop->iteration >= 4)
          @endforeach
          @endif
      </ul>
        <ul class="booktextlist hottextlist">
           @if ($weixinTuijianDatas->count() > 0)
           @foreach ($weixinTuijianDatas as $weixinTuijianData)
           @continue($loop->iteration <= 4)
           <li><a href="{{$weixinTuijianData->weixinlink}}" class="name">{{$weixinTuijianData->articlename}}：<em class="gray">{{$weixinTuijianData->intro}}</em></a></li>
           @break($loop->iteration >= 6)
           @endforeach
           @endif
       </ul>
    </div>

    <div class="module mt10">
        <div class="module-hd"><h2>会员推荐</h2></div>
        <ul class="clearfix bookimglist">
          @if ($weixinHitDatas->count() > 0)
          @foreach ($weixinHitDatas as $weixinHitData)
            <li>
                <a href="{{ $weixinHitData->relationArticles->weixinlink}}">
                    <img src="{{ $weixinHitData->relationArticles->imgflag}}" alt="{{$weixinHitData->relationArticles->articlename}}" class="pic" />
                    <p class="name">{{$weixinHitData->relationArticles->articlename}}</p>
                </a>
            </li>
            @break($loop->iteration >= 4)
          @endforeach
          @endif
          </ul>

          <ul class="imgtextlist hottextlist">
            @if ($weixinHitDatas->count() > 0)
            @foreach ($weixinHitDatas as $weixinHitData)
            @continue($loop->iteration <= 4)
            <li>
              <a href="{{ $weixinHitData->relationArticles->weixinlink}}" class="pic">
                <img src="{{ $weixinHitData->relationArticles->imgflag}}" alt="{{$weixinHitData->relationArticles->articlename}}" /></a>
                <p class="title"><a href="{{ $weixinHitData->relationArticles->weixinlink}}">{{$weixinHitData->relationArticles->articlename}}</a></p>
                <p class="author">{{ $weixinHitData->relationArticles->author}}&nbsp;著</p>
                <p class="intro">{{$weixinHitData->relationArticles->intro}}</p>
            </li>
            @break($loop->iteration >= 6)
            @endforeach
            @endif
          </ul>
    </div>

    <div class="module mt10">
        <div class="module-hd"><h2>新书推荐</h2></div>
        <ul class="imgtextlist">
          @if ($weixinNewBookDatas->count() > 0)
            @foreach ($weixinNewBookDatas as $weixinNewBookData)
            <li>
              <a href="{{ $weixinNewBookData->weixinlink}}" class="pic">
                <img src="{{ $weixinNewBookData->imgflag}}" alt="{{$weixinNewBookData->articlename}}" /></a>
                <p class="title"><a href="{{ $weixinNewBookData->weixinlink}}">{{$weixinNewBookData->articlename}}</a></p>
                <p class="author">{{ $weixinNewBookData->author}}&nbsp;著</p>
                <p class="intro">{{$weixinNewBookData->intro}}</p>
            </li>
            @break($loop->iteration >= 2)
            @endforeach
          @endif
        </ul>

        <ul class="rcmdtextlist mt10">
            @if ($weixinNewBookDatas->count() > 0)
            @foreach ($weixinNewBookDatas as $weixinNewBookData)
            @continue($loop->iteration <= 4)
            <li>
              <p class="title"><a href="{{ $weixinNewBookData->weixinlink}}">{{$weixinNewBookData->articlename}}</a>
                <span class="ml10 author">{{ $weixinNewBookData->author}}</span></p>
                <p class="mt5 intro">{{$weixinNewBookData->intro}}</p>
            </li>
            @endforeach
            @endif
         </ul>
     </div>

     <div class="module mt10">
                <div class="module-hd"><h2>完本佳作</h2></div>
                <ul class="clearfix bookimglist" style="padding-bottom:0">
                  <li>
                      <a href="/book/2296/">
                          <img src="http://res.xiaoshuo520.com/cover/2/2296_s.jpg" alt="双面邪王的冒牌妃" class="pic" />
                          <p class="name">双面邪王的冒牌妃</p>
                      </a>
                  </li>
                  <li>
                      <a href="/book/2213/">
                          <img src="http://res.xiaoshuo520.com/cover/2/2213_s.jpg" alt="痞妃归来：误惹腹黑冷王" class="pic" />
                          <p class="name">痞妃归来：误惹腹黑冷王</p>
                      </a>
                  </li>
                  <li>
                      <a href="/book/2188/">
                          <img src="http://res.xiaoshuo520.com/cover/2/2188_s.jpg" alt="丑妃当道：妖孽残王扶上榻" class="pic" />
                          <p class="name">丑妃当道：妖孽残王扶上榻</p>
                      </a>
                  </li>
                  <li>
                      <a href="/book/2008/">
                          <img src="http://res.xiaoshuo520.com/cover/2/2008_s.jpg" alt="脱轨迷情：总裁溺宠错爱妻" class="pic" />
                          <p class="name">脱轨迷情：总裁溺宠错爱妻</p>
                      </a>
                  </li>
                  <li>
                      <a href="/book/2224/">
                          <img src="http://res.xiaoshuo520.com/cover/2/2224_s.jpg" alt="婚后盛宠：总裁缠绵不休" class="pic" />
                          <p class="name">婚后盛宠：总裁缠绵不休</p>
                      </a>
                  </li>
                  <li>
                      <a href="/book/1890/">
                          <img src="http://res.xiaoshuo520.com/cover/1/1890_s.jpg" alt="甜婚蜜恋：总裁挚爱闪婚妻" class="pic" />
                          <p class="name">甜婚蜜恋：总裁挚爱闪婚妻</p>
                      </a>
                  </li>
                  <li>
                      <a href="/book/2137/">
                          <img src="http://res.xiaoshuo520.com/cover/2/2137_s.jpg" alt="冷夫追妻之妈咪快逃" class="pic" />
                          <p class="name">冷夫追妻之妈咪快逃</p>
                      </a>
                  </li>
                  <li>
                      <a href="/book/509/">
                          <img src="http://res.xiaoshuo520.com/cover/0/509_s.jpg" alt="萌妃嫁临：皇上快接招" class="pic" />
                          <p class="name">萌妃嫁临：皇上快接招</p>
                      </a>
                  </li>
              </ul>
      </div>
      <div class="module mt10">
          <div class="module-hd"><h2>畅销书单</h2></div>
          <ul class="booktextlist">
              <li><a href="/book/category/3/" class="orange">[穿越]</a><a href="/book/2324/" class="ml5 name">冥帝绝宠：逆天神医毒妃</a></li>
              <li><a href="/book/category/6/" class="orange">[都市]</a><a href="/book/2001/" class="ml5 name">枕上甜妻：冷情老公太危险</a></li>
              <li><a href="/book/category/6/" class="orange">[都市]</a><a href="/book/2057/" class="ml5 name">余生太久，爱你会痛</a></li>
              <li><a href="/book/category/6/" class="orange">[都市]</a><a href="/book/2179/" class="ml5 name">迷婚：偷心总裁，要定你</a></li>
              <li><a href="/book/category/6/" class="orange">[都市]</a><a href="/book/2431/" class="ml5 name">因为刚好遇上你</a></li>
              <li><a href="/book/category/6/" class="orange">[都市]</a><a href="/book/2206/" class="ml5 name">甜蜜婚宠：俏皮小娇妻</a></li>
              <li><a href="/book/category/6/" class="orange">[都市]</a><a href="/book/2168/" class="ml5 name">独家甜心妻</a></li>
              <li><a href="/book/category/6/" class="orange">[都市]</a><a href="/book/2145/" class="ml5 name">一世成宠</a></li>
              <li><a href="/book/category/6/" class="orange">[都市]</a><a href="/book/2141/" class="ml5 name">蜜爱成婚</a></li>
              <li><a href="/book/category/6/" class="orange">[都市]</a><a href="/book/2083/" class="ml5 name">复婚，请签字</a></li>
          </ul>
      </div>
</div>

@include('weixin.include.footer')














@endsection
