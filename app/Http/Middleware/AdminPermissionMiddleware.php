<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\AdminPermission;

class AdminPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		$permission = AdminPermission::where('uri', 'like', '%' . $request->path() . '%')->first();
		
		if(!is_null($permission)) {
			if(Auth::user()->rank > $permission->rank) {
				return redirect()->back()->with('permission_denied', '접근 권한이 없습니다.');
			}
		}
		
        return $next($request);
    }
}
