<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->sanitize();

        return [
            'name'            => 'required',
            'emailaddress'    => 'nullable|email',
            'website'         => 'nullable|url',
            'facebook'        => 'nullable|url',
            'twitter'         => 'nullable|url',
            'linkedin'        => 'nullable|url',
            'googleplus'      => 'nullable|url',
            'coordinates_lat' => 'nullable|lat',
            'coordinates_lng' => 'nullable|lng',
        ];
    }

    public function sanitize()
    {
        $input = $this->all();

        foreach ($input as $field => $value) {
            $input[$field] = strip_tags($value);
        }

        $this->replace($input);
    }
}
