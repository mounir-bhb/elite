<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class SharedPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()){
            /* $user=auth()->user()->with('roleable'); */
            /* $sex= auth()->user()->roleable->sex;
            $photo= auth()->user()->roleable->photo_url; */
            auth()->user()->roleable;
            
        }
        
        Inertia::share([
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'canAdministrate' => Gate::allows('administrate', Admin::class),
            'canCreate' => Gate::allows('create', Teacher::class),
            'canSurfe' =>Gate::allows('surfe', Student::class)
        ]);
        
        
        return $next($request);
    }
}
