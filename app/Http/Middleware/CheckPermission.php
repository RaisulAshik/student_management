<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
         $user = Auth::guard('admin')->user();

        if (!$user) {
            return redirect()->route('admin.login');
        }

        // dd($permission);
        
        // dd($user->can($permission));
        // if (!$user->can($permission)) {
        //     abort(403, 'Unauthorized action.');
        // }

        // DEBUG: Check what's happening
        // dd([
        //     'user_id' => $user->id,
        //     'user_email' => $user->email,
        //     'required_permission' => $permission,
        //     'user_roles' => $user->roles->pluck('name')->toArray(),
        //     'user_permissions' => $user->getAllPermissions()->pluck('name')->toArray(),
        //     'has_permission' => $user->hasPermissionTo($permission, 'admin'),
        // ]);

        if (!$user->hasPermissionTo($permission, 'admin')) {
        abort(403, 'Unauthorized action. You do not have permission: ' . $permission);
        }

        return $next($request);
    }
}