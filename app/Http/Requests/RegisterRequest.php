<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      switch($this->method())
      {
        case 'GET':
        case 'POST':
        {
            //bail 属性第一次验证失败后停止运行验证规则
            return [
                'uname'       => 'required|alpha_dash|max:30|unique:jieqi_system_users,uname',
                'pass'          => 'required|confirmed|min:6|max:16',
                'pass_confirmation'           => 'required|min:6|max:16',
            ];
        }
        default:
        {
            return [];
        };


      }

    }
}
