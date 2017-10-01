<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class Honor extends Model
{
    protected $table = 'jieqi_system_honors';
    protected $primaryKey = 'honorid';
    protected $casts = [
        'setting' => 'json',
    ];

    public function getMassageMaxCount()
    {
      return isset($this->setting['maxmessage']) ? $this->setting['maxmessage'] : MASSAGEMAXCOUNT;
    }

    public function getBookcaseCount()
    {
      return isset($this->setting['bookcasecount']) ? $this->setting['bookcasecount'] : BOOKCASEMAXCOUNT;
    }
    public function getDayRecommendCount()
    {
      return isset($this->setting['dayrecommendcount']) ? $this->setting['dayrecommendcount'] : DAYRECOMMENDMAXCOUNT;
    }
}
