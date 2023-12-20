<?php

namespace App\Http\Controllers\Validate;

use App\DTO\ValidateTokenDTO;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\IPasswordRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class ValidateTokenController extends Controller
{
    public function __construct(
        protected IPasswordRepository $passwordRepository,
        protected HasherContract $hasher
    ) {
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $request = $request->validate([
            'token' => ['required', 'string', 'max:70'],
            'email' => ['email', 'string', 'max:250', 'required']
        ]);
        $data = new ValidateTokenDTO(...$request);

        $reset = $this->passwordRepository->validateResetToken($data->email);
        if (!$reset)
            throw new ModelNotFoundException('Token inválido');
        $validateToken = $this->hasher->check($data->token, $reset->token);

        if (!$validateToken)
            return $this->send(false);
        return $this->send(true);
    }
}
