<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class groupReq extends FormRequest
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
            //
			'grpName'=>'required',
			'name'=>'unique:groups',
        ];
    }

	public function messages(){
		return[
		'grpName.required'=>'Group name field require',
		'name.unique'=>'Duplicate name should be unique',
		];
	}	
}