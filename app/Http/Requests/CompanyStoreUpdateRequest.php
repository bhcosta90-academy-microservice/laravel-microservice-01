<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreUpdateRequest extends FormRequest
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
        $url = $this->route('company');

        $ret = [
            'name' => "required|min:3|max:150|unique:companies,name,{$url},uuid",
            'category_id' => 'required|exists:categories,id',
            'whatsapp' => "required|unique:companies,whatsapp,{$url},uuid",
            "email" => "required|email|unique:companies,email,{$url},uuid",
            "phone" => "nullable",
            "facebook" => "nullable",
            "instagram" => "nullable",
            "youtube" => "nullable",
            'image' => ['required', 'image', 'max:1024'],
        ];

        if ($this->method() == 'PUT') {
            $ret['image'] = ['nullable', 'image', 'max:1024'];
        }

        return $ret;
    }
}
