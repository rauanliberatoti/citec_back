<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interface\IPasswordRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasswordRepository implements IPasswordRepository {
    public function saveToken(string $email, string $token) {
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'email' => $email,
                'token' => Hash::make($token),
                'created_at' => Carbon::now(),
            ],
        );
    }

    public function validateResetToken(string $email) {
        $email = DB::table('password_reset_tokens')->where('email', $email)->where('created_at', '>', Carbon::now()->subHours(1))->first();
        return $email;
    }

    public function changePassword(string $password, int $id) {
        $user = User::find($id);
        $user->update(['password' => Hash::make($password)]);
    }

}
