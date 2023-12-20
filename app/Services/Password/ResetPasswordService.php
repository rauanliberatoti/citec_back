<?php

namespace App\Services\Password;
use App\DTO\ResetPasswordDTO;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordService
{
    public function __construct()
    {
    }

    public function handle(ResetPasswordDTO $data)
    {
        $status = Password::reset([
            'email' => $data->email,
            'token' => $data->token,
            'password' => $data->password,
            'password_confirmation' => $data->password_confirmation
        ], function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        });

        return match ($status) {
            Password::INVALID_TOKEN => throw new \DomainException(trans_choice('validation.invalid', 0, [
                'attribute' => 'token',
            ])),
            Password::INVALID_USER => throw new ModelNotFoundException(__('app_exceptions.user_not_found', [
                'entity' => __('validations.attribute.user'),
            ])),
            Password::PASSWORD_RESET => true
        };
    }
}
