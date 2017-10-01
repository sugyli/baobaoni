<?php

namespace App\Admin\Extensions\Traits;

use Illuminate\Support\MessageBag;
trait PublicTrait
{
  public function success($message)
  {
    $success = new MessageBag([
                'title'   => '提示',
                'message' => $message,
              ]);

    return compact('success');
  }

  public function error($error)
  {
    $error = new MessageBag([
                'title'   => '提示',
                'message' => $error,
              ]);

    return compact('error');
  }

}
