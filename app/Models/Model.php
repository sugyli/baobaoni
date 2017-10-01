<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    protected $guarded = [];
    /**
     * 不可被批量赋值的属性。如果设置空数组 就是都可以被赋值
     *
     * @var array
     */
    //protected $guarded = ['price'];
    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    //protected $fillable = ['name'];
}
