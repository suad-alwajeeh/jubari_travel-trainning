<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class customAuth
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
           $path=$request->path();
           $session=Session::get('id');
           echo $path;
           echo $session;
           if($path == 'sign_in' && Session()->has('id')){
               return redirect('/');
           }else if($path !='sign_in' && !(Session()->has('id'))){
         //return redirect('sign_in');
            echo $path;
           echo $session;
        }
        return $next($request);
    }
}
