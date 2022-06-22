<?php
/**
 * @author REDHEAD-DEV => Kravchenko Dmitriy
 */
namespace App\Http\Requests\News;

use App\Http\Traits\ResponseBody;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreNewsRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:8',
            'description' => 'required|string|min:15',
            'text' => 'required|string|min:40',
            'image' => 'required|string'
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
