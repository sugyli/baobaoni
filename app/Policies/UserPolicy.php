<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\User;
class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    //接收两个参数，第一个参数默认为当前登录用户实例，第二个参数则为要进行授权的用户实例
    public function isMe(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

}
