<?php
namespace App\Http\Middleware;
use Closure; use Illuminate\Http\Request;
class AdminAuth { public function handle(Request $request, Closure $next) { return $request->session()->has('admin_id') ? $next($request) : redirect()->route('admin.login'); } }
