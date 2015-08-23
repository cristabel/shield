<?php namespace Cristabel\Shield\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'min:8'
        ];
    }
}
