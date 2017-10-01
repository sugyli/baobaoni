<?php

namespace App\Models;


class Qiandao extends Model
{
    protected $guarded = ['id'];
    protected $table = 'go123_plugin_qiandao';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function batchAssignment($nowtime ,$lianxu_days = true , $month_days = true)
    {
        $month_days ? $this->month_days = $this->month_days +1 : $this->month_days = 1;
        $lianxu_days ? $this->lianxu_days = $this->lianxu_days +1 : $this->lianxu_days = 1 ;
        $this->last_dateline = $nowtime;
        $this->alldays = $this->alldays +1;
        $this->save();
    }

    public function getLastDateAttribute()
    {
        return formatTime($this->attributes['last_dateline']);
    }
}
