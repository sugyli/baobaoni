<?php

namespace App\Http\Controllers\MNovels;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Auth;
use App\Http\Controllers\Traits\AuthenticatesUsers;

class RegisterController extends Controller
{

    use  AuthenticatesUsers;

    public function __construct()
    {

        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }
    public function create(){

      $submitAddress = $this->getSubmitAddress();

      return view('mnovels.register',$submitAddress);
    }


    public function store(RegisterRequest $request)
    {
      $email = User::createEmail();
      $t = time();
      $user = User::create([
          'uname' => $request->uname,
          'pass' => md5($request->pass),
          'groupid' => 3,
          'regdate' => $t,
          'lastlogin'=> $t,
          'viewemail'=> 1,
          'adminemail'=> 0,
          'email' => $email,
      ]);
      if (!$user) {
          return $this->sendFailedLoginResponse($request,'auth.rfailed');
      }

      Auth::login($user, true); //免登陆
      return $this->authenticated();
      //跳转
      //return redirect()->intended(route('web.users', [Auth::user()]));

    }
}
