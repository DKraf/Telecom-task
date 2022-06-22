<?php
/**
 * @author REDHEAD-DEV => Kravchenko Dmitriy
 */
namespace App\Http\Requests\Auth;

use App\Http\Traits\ResponseBody;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginAuthRequest extends FormRequest
{

    /**
     * Правила валидации
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ];
    }


    /**
     * @param Validator $validator
     * @return void
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(ResponseBody::getBody(
            $validator->errors(),
            false,
            'Ошибка ввода данных'
        )));
    }
}
