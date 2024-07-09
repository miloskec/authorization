<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckPermissionsController extends Controller
{
    public function checkPermissions(Request $request)
    {
        $username = $request->input('username');
        $email = $request->input('email');
        Log::channel('authorization')->info(json_encode([$username, $email]));
        $user = User::where('username', $username)->where('email', $email)->first();
        Log::channel('authorization')->info($user);
        if (! $user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        Log::channel('authorization')->info(User::find(1)->getAllPermissions());
        $directPermissions = $user->getDirectPermissions();
        $rolePermissions = $user->getPermissionsViaRoles();
        $allPermissions = $user->getAllPermissions();
        $roles = $user->getRoleNames();

        return response()->json([
            'direct_permissions' => $directPermissions,
            'role_permissions' => $rolePermissions,
            'all_permissions' => $allPermissions,
            'roles' => $roles,
        ]);
    }

    public function getRoles(Request $request)
    {
        $username = $request->input('username');
        $email = $request->input('email');

        Log::channel('authorization')->info(json_encode([$username, $email]));
        $user = User::where('username', $username)->where('email', $email)->first();
        Log::channel('authorization')->info($user);

        if (! $user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $roles = $user->getRoleNames();

        return response()->json([
            'roles' => $roles,
        ]);
    }
}
