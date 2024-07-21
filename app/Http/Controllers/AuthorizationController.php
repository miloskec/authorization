<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthorizationController extends Controller
{
    public function checkEmailHeader(Request $request)
    {
        $user = $request->attributes->get('authenticated_user');
        $user->full_name = 'Micro Services Test 4567';
        $user->save();
        Log::channel('authorization')->info($user);
        return response()->json([
            'user_from_token' => $request->attributes->get('authenticated_user'),
        ]);
    }
}
