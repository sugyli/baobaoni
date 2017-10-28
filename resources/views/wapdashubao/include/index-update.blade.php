@if ($updataBooks->count() > 0)
<section class="i-up">
  <div class="i-up-header">
    <p class="i-up-header-title">
      最新更新
    </p>
  </div>
    <ul class="i-up-list Displayanimation">
      @foreach ($updataBooks as $updataBook)
      <li>
          <div class="i-up-list-main">
            <a href="{{$updataBook->link()}}">
              <div class="i-up-list-main-left">
                <img src="{{ $updataBook->imgflag }}"/>
                <p class="i-up-list-main-state">
                  {{$updataBook->fullflag}}
                </p>
                <div class="i-up-list-main__order">{{$loop->iteration}}</div>
              </div>
              <div class="i-up-list-main-right">
                <p class="i-up-list-main-right-bookname">
                  {{$updataBook->articlename}}
                </p>

                <p class="i-up-list-main-right-author">
                  {{$updataBook->author}}
                </p>

                <p class="i-up-list-main-right-info">
                  {{ str_limit($updataBook->intro, 200) }}
                </p>
                <div class="i-up-list-main-right-tags">
                  <div class="i-up-list-main-right-tags-tag">{{$updataBook->getSort()['title'] or '未知分类'}}</div>
                </div>

              </div>
            </a>
          </div>

      </li>
      @break($loop->iteration >= 1)
      @endforeach

      @foreach ($updataBooks as $updataBook)
      @continue($loop->iteration <=1)
      <li>
        <a href="{{ $updataBook->link() }}">
          <div class="i-up-list-main i-up-list-mainnoimg">
            <span class="i-up-list-mainnoimg-left">0{{$loop->iteration}}</span>
            <div class="i-up-list-mainnoimg-right">
              <div class="i-up-list-mainnoimg-right-bookname">
                {{$updataBook->articlename}}
              </div>
            </div>
          </div>
        </a>
      </li>
      @break($loop->iteration >= 6)
      @endforeach
</section>
@endif
