<?php

namespace App\Contexts\Security\Infrastructure\Requests;

use App\Contexts\Security\Infrastructure\LaravelModels\UserEloquentModel; 
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                // Cambiado $this->user()->id por auth()->id()
                Rule::unique(UserEloquentModel::class)->ignore(auth()->id()),
            ],
        ];
    }
}