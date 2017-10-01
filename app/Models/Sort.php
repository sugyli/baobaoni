<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;

class Sort extends Model
{
    use ModelTree, AdminBuilder;
    protected $guarded = ['id'];
    protected $table = 'sorts';
}
