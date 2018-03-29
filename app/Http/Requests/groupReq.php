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
			'itemType'=>'required',
			
        ];
    }

	public function messages(){
		return[
		'itemType.required'=>'Item Type is required, shouldn\'t be empty.',
		
		];
	}	
}
