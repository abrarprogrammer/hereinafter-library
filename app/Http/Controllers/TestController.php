<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function generateToken(User $user)
    {
        $token = $user->createToken($user->email)->plainTextToken;

        return response()->json(['success' => true, 'token' => $token], 200);
    }
}
