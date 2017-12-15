@extends('weixin.layouts.default')
@section('title'){{config('app.weixin_name')}}-{{config('app.url_weixin')}}@endsection

@section('content')
<div class="module mt10">
   <div class="module-hd"><h2>热门小说</h2></div>

   <ul class="clearfix bookimglist">
      <li>
          <a href="/book/2185/">
              <img src="http://res.xiaoshuo520.com/cover/2/2185_s.jpg" alt="毒妃来袭：冷面战王不好当" class="pic" />
              <p class="name">毒妃来袭：冷面战王不好当</p>
          </a>
      </li>
      <li>
          <a href="/book/2128/">
              <img src="http://res.xiaoshuo520.com/cover/2/2128_s.jpg" alt="首席强爱：小妻带球跑" class="pic" />
              <p class="name">首席强爱：小妻带球跑</p>
          </a>
      </li>
      <li>
          <a href="/book/2235/">
              <img src="http://res.xiaoshuo520.com/cover/2/2235_s.jpg" alt="冰山总裁：替嫁娇妻要逃婚" class="pic" />
              <p class="name">冰山总裁：替嫁娇妻要逃婚</p>
          </a>
      </li>


  </ul>
    <ul class="booktextlist hottextlist">
           <li><a href="javascript:void(0);" class="orange">虐恋</a><span class="vline">|</span><a href="/book/2278/" class="name">宠妻成瘾：总裁，请低调：<em class="gray">面对一场以歉疚弥补拉开的爱情，以及眼前</em></a></li>
           <li><a href="javascript:void(0);" class="orange">宠爱</a><span class="vline">|</span><a href="/book/2296/" class="name">双面邪王的冒牌妃：<em class="gray">一朝穿越，她一个21世纪的女中医博</em></a></li>
           <li><a href="javascript:void(0);" class="orange">鬼夫</a><span class="vline">|</span><a href="/book/2304/" class="name">傲娇鬼夫夜夜袭：<em class="gray">永远都别对一个鬼说去吃别人，因为你会被他吃的连渣都不剩。 </em></a></li>
           <li><a href="javascript:void(0);" class="orange">闪婚</a><span class="vline">|</span><a href="/book/1890/" class="name">甜婚蜜恋：总裁挚爱闪婚妻：<em class="gray">我未婚夫才出轨，这位老总你挖墙脚也太快了一点吧！</em></a></li>
           <li><a href="javascript:void(0);" class="orange">虐爱</a><span class="vline">|</span><a href="/book/2180/" class="name">豪门情劫：杠上冷情恶少：<em class="gray">那夜，他将她吃干抹净，依然不忘记羞辱她无法改变的身份</em></a></li>
   </ul>
</div>

<div class="module mt10">
    <div class="module-hd"><h2>精品推荐</h2></div>
    <ul class="clearfix bookimglist">
        <li>
            <a href="/book/2315/">
                <img src="http://res.xiaoshuo520.com/cover/2/2315_s.jpg" alt="名门婚恋：总裁娇妻很撩人" class="pic" />
                <p class="name">名门婚恋：总裁娇妻很撩人</p>
            </a>
        </li>
        <li>
            <a href="/book/2326/">
                <img src="http://res.xiaoshuo520.com/cover/2/2326_s.jpg" alt="鬼王宠妃：嫡女狂妃要翻身" class="pic" />
                <p class="name">鬼王宠妃：嫡女狂妃要翻身</p>
            </a>
        </li>
        <li>
            <a href="/book/2276/">
                <img src="http://res.xiaoshuo520.com/cover/2/2276_s.jpg" alt="转角遇到爱" class="pic" />
                <p class="name">转角遇到爱</p>
            </a>
        </li>
        <li>
            <a href="/book/2177/">
                <img src="http://res.xiaoshuo520.com/cover/2/2177_s.jpg" alt="惹上邪情少董：妈咪带球跑" class="pic" />
                <p class="name">惹上邪情少董：妈咪带球跑</p>
            </a>
        </li>
      </ul>

      <ul class="imgtextlist hottextlist">
        <li>
          <a href="/book/2303/" class="pic"><img src="http://res.xiaoshuo520.com/cover/2/2303.jpg" alt="天才萌宝腹黑娘亲" /></a>
            <p class="title"><a href="/book/2303/">天才萌宝腹黑娘亲</a></p>
            <p class="author">闻人&nbsp;著</p>
            <p class="intro">惨遭亲信背叛，暗门之主穿越至赫连家废材长公主之身。...</p>
        </li>
        <li>
          <a href="/book/2288/" class="pic"><img src="http://res.xiaoshuo520.com/cover/2/2288.jpg" alt="蜜爱成婚：总裁爱吃回头草" /></a>
            <p class="title"><a href="/book/2288/">蜜爱成婚：总裁爱吃回头草</a></p>
            <p class="author">郁流苏&nbsp;著</p>
            <p class="intro">八年前，他残忍离去，缺席了她最好的年华。八年后，他...</p>
        </li>
      </ul>
</div>

<div class="module mt10">
    <div class="module-hd"><h2>新书推荐</h2></div>
    <ul class="imgtextlist">
        <li>
          <a href="/book/2295/" class="pic"><img src="http://res.xiaoshuo520.com/cover/2/2295_s.jpg" alt="阴婚诡嫁：妖孽鬼夫缠上身" /></a>
            <p class="title"><a href="/book/2295/">阴婚诡嫁：妖孽鬼夫缠上身</a></p>
            <p class="author">水月月&nbsp;著</p>
            <p class="intro">自从参加了一场乔家寨的祭拜月神仪式后，我惹上了一只...</p>
        </li>
        <li>
          <a href="/book/2322/" class="pic"><img src="http://res.xiaoshuo520.com/cover/2/2322_s.jpg" alt="盛世宠婚：首席老公求亲" /></a>
            <p class="title"><a href="/book/2322/">盛世宠婚：首席老公求亲</a></p>
            <p class="author">陨尘&nbsp;著</p>
            <p class="intro">失恋买醉，却被人暗算，慕清芸想，没有比这更狗血的事...</p>
        </li>
    </ul>

    <ul class="rcmdtextlist mt10">
        <li>
          <p class="title"><a href="/book/2318/">残王枭宠：王妃驭夫有道</a><span class="ml10 author">马语孝</span></p>
            <p class="mt5 intro">被瘸腿王爷玩壁咚是个什么样的体验？好惨，呃，为毛要嫁给那个双腿残疾的夫...</p>
        </li>
        <li>
          <p class="title"><a href="/book/2272/">高门重生之腹黑嫡妻</a><span class="ml10 author">昨夜星辰</span></p>
            <p class="mt5 intro">上一世，她视为手足的妹妹爬上了她掏心掏肺的夫君的床，他们欣赏着她关进猪...</p>
        </li>
        <li>
          <p class="title"><a href="/book/2283/">鬼夫诱宠</a><span class="ml10 author">醉今朝</span></p>
            <p class="mt5 intro">我叫夕瑶，是一名即将毕业的考古系学生。在一次探墓考古的过程中，误打误撞...</p>
        </li>
        <li>
          <p class="title"><a href="/book/2285/">腹黑Boss诱宠绝色俏妻</a><span class="ml10 author">冬眠  </span></p>
            <p class="mt5 intro">结婚三年，不知老公是谁。一次阴差阳错的相亲，认识了富可敌国的总裁龙泽焕...</p>
        </li>
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











@endsection
