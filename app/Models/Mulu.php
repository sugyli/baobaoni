<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Mulu extends Model
{
    use SoftDeletes;
    protected $guarded = ['bid'];
    protected $table = 'jieqi_mulu';
    protected $primaryKey = 'bid';


}
