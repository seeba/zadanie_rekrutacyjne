<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProgrammer extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return  [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required'],
            'pesel' => ['required', 'PESEL'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'langs.*' => ['distinct', 'required']
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Imię jest wymagane',
            'last_name.required' => 'Nazwisko jest wymagane',
            'email.required' => 'Email jest wymagany',
            'email.email' => 'Wpisz poprawny email',
            'pesel.PESEL' => 'PESEL nie jest poprawny',
            'pesel.required' => 'PESEL jest wymagany',
            'pesel.unique' => 'Istnieje użytkownik w bazie z takim nr PESEL',
            'languages.*.name.distinct' => 'Nie można wpisać dwóch takich samych języków programowania'
        ];
    }
}
