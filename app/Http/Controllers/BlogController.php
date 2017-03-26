<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Income;
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
     * Home page of grouppie.
     *
     * @return mixed
     */
    public function getIndex() {

        // Brings the user's id.
        $user = Auth::id();

        // Pagination for posts.
        $posts = Post::orderBy('id', 'desc')->paginate(4);

        // Get all the expenses.
        $expenses = Expense::where('user_id', $user)->orderBy('id', 'desc')->get();

        // Get all the incomes.
        $incomes = Income::where('user_id', $user)->orderBy('id', 'desc')->get();

        // Return the view with parameters.
        return view('blog.index')
            ->withPosts($posts)
            ->withExpenses($expenses)
            ->withIncomes($incomes);
    }

    /**
     * Show each post.
     *
     * @param $id
     * @return mixed
     */
    public function getSingle($id) {

        // Fetch the post from DB.
        $post = Post::find($id);

        // Return the view.
        return view('blog.single')->withPost($post);
    }
}
