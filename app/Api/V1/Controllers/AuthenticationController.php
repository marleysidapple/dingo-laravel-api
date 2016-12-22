<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\RegisterRequest;
use App\Api\V1\Requests\LoginRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use JWTAuth;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request)
    {
    	$registrationData = array('name' => $request->name, 'email' => $request->email, 'password' => \bcrypt($request->password));
    	$user = User::create($registrationData);

    	if (!$user){
    		throw new HttpException(500);
    	}

    	return response()->json(['status' => 'ok'], 200);
    }



    public function login(LoginRequest $request)
    {
    	$acceptedField = $request->only('email', 'password');
    	try {
    		if (! $token = JWTAuth::attempt($acceptedField)){
    			 throw new AccessDeniedHttpException();
    		}
    	} catch (JWTException $e) {
    			throw new Exception(500);
    			
    	}

    	return response()->json(['status' => 'ok', 'token' => $token], 200);
    }
}
