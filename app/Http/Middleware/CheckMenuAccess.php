<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SETTING_MENU_USER;

class CheckMenuAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  $menuId
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $menuId)
    {
        $user = Auth::user();

        // Periksa apakah pengguna memiliki akses ke menu
        $hasAccess = SETTING_MENU_USER::where('ID_JENIS_USER', $user->ID_JENIS_USER)
                    ->where('MENU_ID', $menuId)
                    ->exists();

        if (!$hasAccess) {
            return redirect('/unauthorized')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
