<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePost extends FormRequest
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
            'postImage'=> 'image|mimes:jpg,jpeg,png,gif,svg',
            'title' => 'required|min:5|max:200',
            'content'=> 'required|min:50|max:8000', 
            'users_id' => 'required|min:1|max:100000',
            'category_Menu'=> 'required'
        ];
    }
}
