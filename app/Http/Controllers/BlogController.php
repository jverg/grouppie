<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class BlogController
 * @package App\Http\Controllers
 */
class BlogController extends Controller {

    /**
     * Welcome page.
     *
     * @return mixed
     */
    public function getIndex() {

        // Pagination for posts.
        $posts = Post::orderBy('id', 'desc')->paginate(4);

        // Return view.
        return view('blog.index')->withPosts($posts);
    }

    public function getSingle($slug) {

        // Fetch from DB.
        $post = Post::where('slug', '=', $slug)->first();

        // Return the view.
        return view('blog.single')->withPost($post);
    }
}
