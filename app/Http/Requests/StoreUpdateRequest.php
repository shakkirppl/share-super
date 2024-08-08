<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use App\Models\User;
use Illuminate\Validation\Rule;
class StoreUpdateRequest extends FormRequest
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
          $storeId = $this->route('store');
        return [
            //
            'code' => ['required', 'string', 'max:255'],
            // 'code' => ['required', 'string',  'max:255', 'unique:'.Store::class],
            'code' => ['required','string', Rule::unique('store')->ignore($storeId),
            ],
            'name' => ['required', 'string', 'max:255'],
          
            'name' => ['required','string', Rule::unique('store')->ignore($storeId),
            ],
            'comapny_id' => ['required', 'integer'],
            'contact_number' => ['required', 'string'],
            'email' => ['required', 'email'],
            // 'username' => ['required', 'email'],
            // 'username' => ['required', 'string',  'max:255', 'unique:'.User::class],
            // 'username'     => 'required|unique:users,email,'.$this->username,
            'username' => ['required','string', Rule::unique('store')->ignore($storeId),
            ],
      
            
        ];
    }
    public function messages()
    {
        return [

            'code.required' => 'Code is required',
            'name.required' => 'Name is required',
            'comapny_id.required' => 'Company is required',
            'contact_number.required' => 'Contact Number is required',
            'email.required' => 'Email is required ',
            'username.required' => 'User Name (Using Email Format) is required',
          
           

        ];
    }
}
