<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegistrationRequest extends FormRequest
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
            'first_name' => ['required','string','min:3','max:50','regex:/^[\pL\s\-]+$/u'],
            'last_name' => ['required','string','min:3','max:50','regex:/^[\pL\s\-]+$/u'],
            'email' => 'required|string|email|unique:users,email|min:3|max:50',
            'phone_number' => ['required', 'regex:/^(00382|[+](382)|(0))[0-9]{8}$/u'],
            'password' => 'required|confirmed|min:8',
            'city_id' => 'required|exists:cities,id',
            'device_id' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Ime mora biti uneseno!',
            'first_name.min' => 'Ime mora sadržati najmanje :min karaktera!',
            'first_name.max' => 'Ime ne može imati više od 50 karaktera!',
            'first_name.regex' => 'Ime ne može sadržati slova i specijalne karaktere!',
            'last_name.required' => 'Prezime mora biti uneseno!',
            'last_name.min' => 'Prezime mora sadržati najmanje :min karaktera!',
            'last_name.max' => 'Prezime ne može imati više od 50 karaktera!',
            'last_name.regex' => 'Prezime ne može sadržati slova i specijalne karaktere!',
            'email.required' => 'Email mora biti unesen!',
            'email.unique' => 'Korisnik već postoji u bazi podataka!',
            'email.min' => 'Email mora imati najmanje :min karaktera!',
            'email.max' => 'Email ne može imati više od 50 karaktera!',
            'phone_number.required' => 'Broj telefona mora biti unesen!',
            'phone_number.regex' => 'Broja telefona mora biti u nekom od datih formata: 00382XXXXXXXX, +382XXXXXXXX ili 0XXXXXXXX!',
            'password.required' => 'Lozinka mora biti unesena!',
            'password.confirm' => 'Lozinka nije uspješno potvrđena!',
            'password.min' => 'Lozinka mora sadržati najmanje :min karaktera!',
            'city_id.required' => 'Izabrani grad nije validan'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['message' => $validator->errors()->first()], 422));
    }
}
