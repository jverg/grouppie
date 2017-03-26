<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

        // Brings the user's id.
        $user = Auth::id();

        // Pagination for posts.
        $posts = Post::orderBy('id', 'desc')->paginate(4);
        $expenses = Expense::where('user_id', $user)->orderBy('id', 'desc')->get();

        // Return view.
        return view('blog.index')->withPosts($posts)->withExpenses($expenses);
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
