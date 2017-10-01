<div class="main re idx_qd f-cb">
  <div class="title">今日签到</div>
  <div class="gundong">
    <ul style="margin-top: 0px;">
      @if($qiandao = qiandaoList())
        @if($qiandao->count() > 0)
          @foreach($qiandao as $item)
          <li>[ {{formatTime($item->last_dateline)}} ]<span> {{$item->username}} </span>已经签到</li>
          @endforeach
        @endif
      @endif
    </ul>
  </div>

  <div class="qiandao">
    <a href="{{route('qiandao.show')}}" title="我要签到">我要签到</a>
  </div>
</div>
