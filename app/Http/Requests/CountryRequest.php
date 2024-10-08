<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;
class CountryRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string',  'max:255', 'unique:'.Country::class],
        ];
    }
    public function messages()
    {
        return [

            'name.required' => 'Name is required',

        ];
    }
}
