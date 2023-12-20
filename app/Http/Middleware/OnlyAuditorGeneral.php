<?php

namespace App\Http\Middleware;

use App\Constants\UserConstant;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class OnlyAuditorGeneral
{
    public function __construct()
    {

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->access_level != UserConstant::GENERAL_AUDITOR){
            throw new AccessDeniedHttpException();
        }
        return $next($request);
    }
}
