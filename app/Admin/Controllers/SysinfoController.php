<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

use App\Admin\Extensions\Tools\Form1;
class SysinfoController extends Controller
{
    use ModelForm;



    public function index()
    {
        return Admin::content(function (Content $content) {

            $showForm = new Form1();

            $content->body($this->grid());
        });
    }
}
