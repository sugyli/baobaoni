@if ($newBookDatas->count() > 0)
<section class="i-hot">
  <div class="i-hot-header">
    <h2 class="i-hot-header-title">重磅推出</h2>
  </div>
  <ul class="i-hot-list Displayanimation">
    @foreach ($newBookDatas as $newBookData)
    <li>
        <a href="{{$newBookData->link()}}">
          <div class="i-hot-list-wrap">
            <div class="i-hot-list-wrap-cover">
              <img src="{{ $newBookData->imgflag }}"/>
              <div class="p-tag -word"></div>
            </div>

            <div class="i-hot-list-wrap-info">
                <h3 class="i-hot-list-wrap-info-title">
                  {{$newBookData->articlename}}
                </h3>
            </div>
          </div>
        </a>
    </li>
    @endforeach
  </ul>
</section>
@endif
