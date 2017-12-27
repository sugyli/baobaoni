@extends('weixin.layouts.default')
@section('title')目录@endsection

@section('content')
  @include('weixin.include.header')
  <div class="content">
    @include('weixin.include.search')
    <div class="module mt10">
      <div class="module-hd"><h2 class="fleft">章节目录</h2>
            <a href="?order=1" class="ml10 fright">倒序</a>
            <a href="?order=0" class="fright red">正序</a>
      </div>
      <ul class="cataloglist">

          <li>
              <a href="/book/2304/1048963/">
                  <span>第一章 一场艳梦之后的血案</span>
                  <span class="time">更新：2017-12-12 14:02</span>
              </a>
          </li>

          <li>
              <a href="/book/2304/1048964/">
                  <span>第二章 被烧的尸体</span>
                  <span class="time">更新：2017-12-12 15:24</span>
              </a>
          </li>

          <li>
              <a href="/book/2304/1048965/">
                  <span>第三章 他来了，请睁眼</span>
                  <span class="time">更新：2017-12-12 17:09</span>
              </a>
          </li>

          <li>
              <a href="/book/2304/1048966/">
                  <span>第四章 总有妖孽缠上我</span>
                  <span class="time">更新：2017-12-12 17:10</span>
              </a>
          </li>

          <li>
              <a href="/book/2304/1048967/">
                  <span>第五章 死者为大，夜半鬼敲</span>
                  <span class="time">更新：2017-12-13 11:44</span>
              </a>
          </li>

          <li>
              <a href="/book/2304/1048968/">
                  <span>第六章 女人，你想非礼我？</span>
                  <span class="time">更新：2017-12-13 11:44</span>
              </a>
          </li>

          <li>
              <a href="/book/2304/1048969/">
                  <span>第七章 女鬼们来了</span>
                  <span class="time">更新：2017-12-13 14:52</span>
              </a>
          </li>

          <li>
              <a href="/book/2304/1048970/">
                  <span>第八章  病人不见了</span>
                  <span class="time">更新：2017-12-13 14:52</span>
              </a>
          </li>

          <li>
              <a href="/book/2304/1048971/">
                  <span>第九章  我们无冤无仇，为什么要害我们！</span>
                  <span class="time">更新：2017-12-13 16:30</span>
              </a>
          </li>

          <li>
              <a href="/book/2304/1048972/">
                  <span>第十章 他是人还是鬼</span>
                  <span class="time">更新：2017-12-13 16:30</span>
              </a>
          </li>

          <li>
              <a href="/book/2304/1048973/">
                  <span>第十一章 我是他的女人么</span>
                  <span class="time">更新：2017-12-14 10:50</span>
              </a>
          </li>

          <li>
              <a href="/book/2304/1048974/">
                  <span>第十二章 杀人偿命，天经地义</span>
                  <span class="time">更新：2017-12-14 11:06</span>
              </a>
          </li>

          <li>
              <a href="/book/2304/1048975/">
                  <span>第十三章 敢惹医生，分分钟穴位按死你</span>
                  <span class="time">更新：2017-12-14 11:06</span>
              </a>
          </li>

          <li>
              <a href="/book/2304/1048976/">
                  <span>第十四章 我怀孕了？</span>
                  <span class="time">更新：2017-12-14 16:17</span>
              </a>
          </li>

          <li>
              <a href="/book/2304/1048977/">
                  <span>第十五章 哥的狐狸爪子</span>
                  <span class="time">更新：2017-12-15 10:42</span>
              </a>
          </li>

          <li>
              <a href="/book/2304/1048978/">
                  <span>第十六章 我哥是只狐狸精</span>
                  <span class="time">更新：2017-12-15 14:09</span>
              </a>
          </li>

          <li>
              <a href="/book/2304/1048979/">
                  <span>第十七章 哥，对不起</span>
                  <span class="time">更新：2017-12-15 14:08</span>
              </a>
          </li>

          <li>
              <a href="/book/2304/1048980/">
                  <span>第十八章 怎么了，女人？</span>
                  <span class="time">更新：2017-12-15 16:13</span>
              </a>
          </li>

          <li>
              <a href="/book/2304/1048981/">
                  <span>第十九章 一双红色绣花鞋</span>
                  <span class="time">更新：2017-12-15 16:56</span>
              </a>
          </li>

          <li>
              <a href="/book/2304/1048982/">
                  <span>第二十章 孩子妈，你没事吧？</span>
                  <span class="time">更新：2017-12-15 17:50</span>
              </a>
          </li>

      </ul>
      <div class="pages">
       <a href="/book/volume/2304/?order=0&page=2" class="next">下一页&gt;</a>
       <div class="skip">
         <form method="post" action="/book/volume/2304/?order=0">
           <input type="number" name="go" placeholder="1" min="1" />
           <input type="submit" value="跳转" />
           <span><em class="f-color-red">1</em>/25</span>
         </form>
       </div>
      </div>
    </div>
    <div class="btlocation">
      <a href="/" class="home"></a>
      <span class="gt">&gt;</span>
      <a href="/book/2304/">傲娇鬼夫夜夜袭</a>
    </div>
  </div>
  @include('weixin.include.footer')
@endsection
