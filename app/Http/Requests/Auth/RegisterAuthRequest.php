<?php
/**
 * @author REDHEAD-DEV => Kravchenko Dmitriy
 */
namespace App\Http\Requests\Auth;

use App\Http\Traits\ResponseBody;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegisterAuthRequest extends FormRequest
{

    /**
     * Правила валидации.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(ResponseBody::getBody(
            $validator->errors(),
            false,
            'Ошибка ввода данных'
        )));
    }
}
