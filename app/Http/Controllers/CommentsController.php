<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Session;

class CommentsController extends Controller {

    public function __construct() {

        $this->middleware('auth', array('except' => 'store'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id) {

        // Validation to store a comment.
        $this->validate($request, array(
            'comment' => 'required|min:5|max:2000',
        ));

        // Find the post that this comment belongs to.
        $post = Post::find($post_id);

        // Create the comment.
        $comment = new Comment();
        $comment->name = Auth::user() ? Auth::user()->name : 'Anonymous';
        $comment->comment = $request->comment;
        $comment->approved = TRUE;
        $comment->post()->associate($post);
        $comment->save();

        // Message for success store of the comment.
        Session::flash('success', 'Comment was added!');

        // Redirect to the post's page.
        return redirect()->route('blog.single', array($post->slug));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        // Brings the user's id.
        $user = Auth::id();

        // Get the id of the user's post.
        $posts = Post::where('user_id', $user)->get();
        $user_posts_id = array();
        foreach ($posts as $post) {
            $user_posts_id[] = $post->id;
        }

        // Bring the comment.
        $comment = Comment::find($id);
        $post_id_of_comment = $comment->post_id;

        // Check if this post belongs to the user.
        if (in_array($post_id_of_comment, $user_posts_id)) {

            // Bring the comment.
            $comment = Comment::find($id);

            // Return the edit comment view.
            return view('comments.edit')->withComment($comment);
        } else {

            // Redirect the user to hoem page.
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        // Bring the comment.
        $comment = Comment::find($id);

        // Validation to update a comment.
        $this->validate($request, array(
            'comment' => 'required|min:5|max:2000',
        ));

        // Save the updated comment.
        $comment->comment = $request->comment;
        $comment->save();

        // Message for success store of the comment.
        Session::flash('success', 'Comment updated');

        // Redirect to the post's page.
        return redirect()->route('posts.show', $comment->post->id);
    }

    /**
     * Function that delete a comment
     *
     * @param $id
     * @return mixed
     */
    public function delete($id) {

        // Bring the comment to delete.
        $comment = Comment::find($id);

        // Return the deletion view.
        return view('comments.delete')->withComment($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        // Delete a comment.
        $comment = Comment::find($id);
        $post_id = $comment->post->id;
        $comment->delete();

        // Success message if a comment deleted successfully.
        Session::flash('success', 'Delete comment');

        // Redirect to post's page.
        return redirect()->route('posts.show', $post_id);
    }
}
