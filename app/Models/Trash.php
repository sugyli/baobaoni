<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
class Trash extends Model
{
    use SoftDeletes;


    /**
     * 获取所有拥有的 trashestable 模型。
     */
    public function trashestable()
    {
        return $this->morphTo();
    }

}
