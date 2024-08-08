<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class RenewelRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'suscription_end_date' => ['required'],
            'store_id' => ['required','integer'],
        ];
    }
    public function messages()
    {
        return [

            'name.required' => 'Suscription End Date is required',

        ];
    }
}
