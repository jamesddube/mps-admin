<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateOrderRequest extends Request
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
        $rules = [
            'hobbies' => 'required',
        ];
        foreach($this->request->get('hobbies') as $key=>$value)
        {
            $rules['items.'.$value] = 'required|integer';
        }
        return $rules;
    }
}
