<?php

namespace App\Http\Controllers\MNovels;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Traits\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Auth;

//Illuminate\Foundation\Auth\AuthenticatesUsers
class LoginController extends Controller
{
    use ThrottlesLogins , AuthenticatesUsers;


    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function create()
    {
      $submitAddress = $this->getSubmitAddress();
      return view('mnovels.login',$submitAddress);

    }

    public function store(LoginRequest $request)
    {

      if ($this->hasTooManyLoginAttempts($request)) {
          $this->fireLockoutEvent($request);

          return $this->sendLockoutResponse($request);
      }
      /*
      $credentials = [
          'uname'    => $request->only($this->username(), 'password'),
          'password' => $request->input('pass'),//千万注意验证一定要起这个名字
      ];
      */

      // 通过 Auth::attempt() 传入 true 值来开启 '记住我' 功能
      if (Auth::attempt($request->only($this->username(), 'password'),true)) {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        //return $this->authenticated($request, $this->guard()->user())
          //      ?: redirect()->intended(route('users.show', [Auth::user()]));
        //成功后跳转到哪
        return $this->authenticated();
      }

      //失败后
      $this->incrementLoginAttempts($request);


      return $this->sendFailedLoginResponse($request);
    }

    public function destroy()
    {
        $redirect_url = request()->redirect_url ?: '/';
        Auth::logout();
        //session()->flash('success', '您已成功退出！');
        return redirect($redirect_url);
    }

}
