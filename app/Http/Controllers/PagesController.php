<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\NovelsController\ArticlesController;

class PagesController extends Controller
{
    public function home()
    {
      return app(ArticlesController::class)->index();
    }
}
