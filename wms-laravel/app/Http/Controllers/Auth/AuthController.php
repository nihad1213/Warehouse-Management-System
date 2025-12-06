<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Auth\LoginService;
use App\Http\Controllers\Controller;
use App\Services\Auth\LogoutService;
use App\Services\Auth\RegisterService;
use App\Dto\Auth\Request\LoginRequestDto;
use App\Dto\Auth\Request\RegisterRequestDto;

class AuthController extends Controller
{
    public function __construct(
        private RegisterService $registerService,
        private LoginService $loginService,
        private LogoutService $logoutService
    )
    {}

    public function register(): JsonResponse
    {
        try {
            $dto = RegisterRequestDto::from(request()->all());
            $response = $this->registerService->regsister($dto);
            
            return response()->json($response->toArray(), 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    public function login(): JsonResponse
    {
        try {
            $dto = LoginRequestDto::from(request()->all());
            $response = $this->loginService->login($dto);
            
            return response()->json($response->toArray(), 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Login failed',
                'error' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    public function logout(LogoutService $logoutService): JsonResponse
    {
        $response = $logoutService->logout();
    
        return response()->json($response->toArray(), 200);
    }
}
