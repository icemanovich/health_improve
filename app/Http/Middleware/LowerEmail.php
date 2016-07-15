<?php
/**
 * User: ignat
 * Date: 16.07.16 0:04
 */

namespace App\Http\Middleware;

use Closure;


class LowerEmail
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
        $input = $request->input();
        if (isset($input['email'])) {
            $input['email'] = mb_strtolower($input['email']);
            $request->merge($input);
        }

        return $next($request);
    }
}