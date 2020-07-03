<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\AlphaNumHalf;
use Illuminate\Support\Facades\Auth;

class UpdateAdminRequest extends FormRequest
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

        return [
            'name' => [
                'required',
                new AlphaNumHalf,
                'max:20',
                'min:3',
                //  Rule::unique('users')->ignore($user)
                ],
            // 'email' => [
            //     Rule::unique('users')->ignore($user)
            //              ],
            'myPic' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048',
            'profile' => ['string','max:500','nullable']
        ];
    }
}
