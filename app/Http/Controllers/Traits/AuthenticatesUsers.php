<?php

namespace App\Http\Controllers\Traits;
use Illuminate\Http\Request;
trait AuthenticatesUsers
{
  public function username()
  {
      return 'uname';
  }

  /**
   * The user has been authenticated.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  mixed  $user
   * @return mixed
   */
  public function authenticated()
  {
    //$backUrl = route('member.show', [Auth::user()]);
    //$redirect_url = \Request::query('redirect_url');
    $redirect_url = request()->redirect_url ?: route('member.show');
    //$redirect_url = request()->input('redirect_url',$backUrl);
    return redirect($redirect_url);
  }

  public function getSubmitAddress()
  {
    //$redirect_url = request()->input('redirect_url');
    //$redirect_url = \Request::query('redirect_url');
    $redirect_url = request()->redirect_url;
    if ($redirect_url) {
      if (str_contains( $redirect_url , route('login.create') ) || str_contains($redirect_url ,route('register.create')) || str_contains($redirect_url ,route('password.create'))) {
          $redirect_url = null;
      }
    }

    $loginSubmitAddress = $redirect_url ? route('login.create').'?redirect_url='.$redirect_url : route('login.create');
    $registerSubmitAddress = $redirect_url ? route('register.create').'?redirect_url='.$redirect_url : route('register.create');
    $passwordSubmitAddress = $redirect_url ? route('password.create').'?redirect_url='.$redirect_url : route('password.create');

    return compact('loginSubmitAddress','registerSubmitAddress','passwordSubmitAddress');
  }

  /**
   * Get the failed login response instance.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function sendFailedLoginResponse(Request $request ,$msg = 'auth.failed')
  {
      $errors = [$this->username() => trans($msg)];

      if ($request->expectsJson()) {
          return response()->json($errors, 422);
      }

      return redirect()->back()
                      ->withInput($request->only($this->username(), 'remember'))
                      ->withErrors($errors);
  }


}
