<?php

namespace App\Http\Middleware;

use App\Post;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class CheckGroup {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if (Auth::check()) {
            $user_group = Auth::user()->group_id;
            $post_path = Request::getPathInfo();
            $post_path = explode("/", $post_path);
            $post_id = $post_path[2];

            $post_group = Post::where('id', $post_id)->where('group_id', $user_group)->orderBy('id', 'desc')->paginate(1);

            if ($post_group[0] == null) {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
