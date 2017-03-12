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
     * Home page.
     *
     * @return mixed
     */
    public function getIndex() {

        // Pagination for posts.
        $posts = Post::orderBy('id', 'desc')->paginate(4);

        // Return view.
        return view('blog.index')->withPosts($posts);
    }

    /**
     * Show each post.
     *
     * @param $id
     * @return mixed
     */
    public function getSingle($id) {

        // Fetch from DB.
        $post = Post::find($id);

        // Return the view.
        return view('blog.single')->withPost($post);
    }
}
