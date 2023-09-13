<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Rules\PasswordComplexRule;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', new PasswordComplexRule],
        ];

        if($this->method() === 'PUT' || $this->method() === 'PATCH'){

            $rules['email'] = [
                'required',
                'min:3',
                /* "unique:supports,subject,{$this->id},id" */
                Rule::unique('users')->ignore($this->user ?? $this->id)

            ];
        }
        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'email.unique' => 'email ja cadastrado',
            'name.min' => 'O campo nome deve ter no mínimo 3 caracteres.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'O campo senha deve ter no mínimo 8 caracteres.',
        ];
    }
}
