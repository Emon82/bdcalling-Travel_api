<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout ( Request $request){

        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);

    }
}
