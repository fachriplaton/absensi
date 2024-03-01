<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next, ...$roles)
  {
    $user = Auth::user();
    if (!$user) {
      return redirect()->route('welcome');
    }
    $roleUser = $user->role;

    foreach ($roles as $role) {
      if ($roleUser == $role) {
        return $next($request);
      }
    }
    return redirect()->route('welcome');
  }
}
