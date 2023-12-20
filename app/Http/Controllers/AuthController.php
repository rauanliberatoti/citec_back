<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct()
    {
    }

    public function control(Request $request): \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
    {

        $credentials = $request->validate([
            'cpf' => ['required'],
            'password' => ['required'],
        ]);


        if (!Auth::attempt(['cpf' => preg_replace('/[^0-9]/', "", $credentials['cpf']), 'password' => $credentials['password']])) {
            throw new ModelNotFoundException(__('app_exceptions.invalid_credentials'));
        }

        $user = Auth::user();
        $token = $user->createToken($user->id);

        return $this->send([
            'token' => $token->plainTextToken,
            'user' => $user,
        ], Response::HTTP_OK);
    }
}
