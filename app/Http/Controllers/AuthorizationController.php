<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    public function checkEmailHeader(Request $request)
    {
        return response()->json([
            'X-User-Email' => $request->hasHeader('X-User-Email'),
        ]);
    }
}
