<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    public function handle(Request $request, Closure $next, $userType): Response
    {
        if(auth()->user()->role == $userType){
            return $next($request);
        } else {
            if (auth()->user()->role == 'admin') {
                return redirect()->route('admin.home');
            } else{
                return redirect()->route('student.home');
            }
        }
        // return redirect()->route('index');
        //  return response()->json(['You do not have permission to access for this page.']);
        /* return response()->view('errors.check-permission'); */
    }

}