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
      return isset($this->setting['maxmessage']) ? $this->setting['maxmessage'] : get_sys_set('massagemaxcount');
    }

    public function getBookcaseCount()
    {
      return isset($this->setting['bookcasecount']) ? $this->setting['bookcasecount'] : get_sys_set('bookcasemaxcount');
    }
    public function getDayRecommendCount()
    {
      return isset($this->setting['dayrecommendcount']) ? $this->setting['dayrecommendcount'] : get_sys_set('dayrecommendmaxcount');
    }
}
