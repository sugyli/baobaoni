<?php

namespace App\Http\Controllers\Traits;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\MessageBag;
trait UsersTrait
{
  public function isDuplicateMessage($content)
  {
      $last_message = Auth::user()->relationOutboxs()
                                ->where('fromdel','!=',1)
                                ->orderBy('messageid', 'desc')
                                ->first();

      return count($last_message) && strcmp($last_message->content, $content) === 0;
  }

  public function creatorFailed($error)
  {
      $error = new MessageBag([
        'error'   => '发布失败：' . $error,
      ]);
      return
              redirect()->back()
                        ->withInput()
                        ->withErrors($error);
  }

}
