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
            'image_url'=> 'required|min:5|max:150',
            'title' => 'required|min:5|max:50',
            'content'=> 'required|min:50|max:1000', 
            'users_id' => 'required|min:1|max:1000'            
        ];
    }
}