<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthenticationController extends Controller
{
    public function register()
    {
    	return response()->json(['message' => 'This is register', 'status' => 200]);
    }
}
