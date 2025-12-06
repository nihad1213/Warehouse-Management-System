<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Auth\RegisterService;
use App\Dto\Auth\Request\RegisterRequestDto;

class AuthController extends Controller
{
    public function __construct(
        private RegisterService $registerService
    )
    {}

    public function register()
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

    public function login()
    {

    }

    public function logout()
    {

    }
}
