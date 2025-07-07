<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        //sub sa pahla ya dakinga ka user login ha ka nhi
           $user = Auth::user();

          //agr nhi ha to osko login page per baj do
          if(!$user){
            return redirect()->route('login')->with('error' , 'please login first');
          } 
             //or login ho ya login kar lia ho to per ya dakinga ga ka ya admin ha ya editor ha to allowed ho wrna nhi ho
          if($user->role->name === 'admin' || $user->role->name === 'editor'){
              return $next($request);
          }else{
             return redirect()->route('login')->with('error' , 'apko admin panel ma access ke ijazat nhi ha');
          }
          


    }
}
