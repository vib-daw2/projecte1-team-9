<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AbleToRead
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, string $id): Response
    {
        // Check if the requested blog is public or not
        $isPublic = DB::table('blogs')->where('id', $id)->first()->status === 'public';

        if (!$isPublic) {
            // Check if the user is logged in
            if (!$request->session()->has('user_id')) {
                return redirect('/login');
            }

            // Check if the user is the owner of the blog or the requesting user is an admin
            $requestingUser = DB::table('users')->where('id', $request->session()->get('user_id'))->first();
            $owner = DB::table('blogs')->where('id', $id)->first()->user_id;
            if ($requestingUser->role !== 'admin' && $requestingUser->id !== $owner) {
                abort(403);
            }
        }

        return $next($request);
    }
}
