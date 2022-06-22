<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginAuthRequest;
use App\Http\Requests\Auth\RegisterAuthRequest;
use App\Http\Traits\ResponseBody;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Метод регистрации пользователя
     *
     * @param RegisterAuthRequest $request
     * @return JsonResponse
     */
    public function register(RegisterAuthRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }


    /**
     *  Метод авторизации пользователя
     *
     * @param LoginAuthRequest $request
     * @return JsonResponse
     */
    public function login(LoginAuthRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(ResponseBody::getBody(
                null,
                false,
                'Введены неверные данные авторизации'
            ), 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(ResponseBody::getBody([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]));
    }
}
