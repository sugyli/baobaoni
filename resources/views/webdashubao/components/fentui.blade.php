@if ($newBookDatas->count() > 0)
<section class="fengtui re f-cb Displayanimation">
  <div class="title">
    <p>
       {{ $fengtuiTitle or '重磅推出' }} <i>{{ $fengtuiTitle_i or '新书' }}</i>
    </p>
  </div>

  @foreach ($newBookDatas as $newBookData)
  <dl>
    <a href="{{$newBookData->link()}}">
      <dt>
        <img src="{{ $newBookData->imgflag }}" alt="{{$newBookData->articlename}}">
        <p>
          {{  $newBookData->fullflag }}
        </p>
        <div class="p-tag">新书</div>
      </dt>
      <dd>
        <h3>{{$newBookData->articlename}}</h3>
        <span>{{$newBookData->author}}</span>
        <p>{{ str_limit($newBookData->intro, 200) }}</p>
      </dd>
    </a>
  </dl>
  @endforeach

</section>
@endif
