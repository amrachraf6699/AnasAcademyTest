<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        if (auth()->attempt($request->only('email', 'password'))) {
            $token = auth()->user()->createToken('authToken')->plainTextToken;

            return $this->SendResponse(200 , 'Welcome back, ' . auth()->user()->name , ['token' => $token]);
        }

        return $this->SendResponse(401 , 'Invalid login details');
    }
}
