<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller {

    /**
     * PostController constructor.
     *
     * In order to only authenticate user access this.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the post.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        // Brings the user's id.
        $user = Auth::id();

        // Brings the current user's posts.
        $posts = Post::where('user_id', $user)->orderBy('id', 'desc')->paginate(4);

        // Return a view and pass in the above variable
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        // Create post form.
        return view('posts.create');
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        // Validate the data.
        $this->validate($request, array(
            'title' => 'required|max:255',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'body' => 'required',
        ));

        // Store in the database
        $post = new Post;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->user_id = Auth::user()->id;

        // Save our image.
        if($request->hasFile('post_images')) {
            $image = $request->file('post_images');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('post_images/' . $filename);
            Image::make($image)->save($location);

            $post->image = $filename;
        }

        $post->save();

        // Success message just for one request.
        Session::flash('success', 'The post was successfully save!');

        // Redirect to the page of the last created post.
        return redirect()->route('posts.show', $post->id);

    }

    /**
     * Display the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        // Brings the user's id.
        $user = Auth::id();

        // Check if the user has access to this post.
        $post = Post::where('user_id', $user)->find($id);
        if ($post) {
            return view('posts.show')->withPost($post);
        } else {
            return $this->index();
        }
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        // Brings the user's id.
        $user = Auth::id();

        // Check if the user has access to this post.
        $post = Post::where('user_id', $user)->find($id);
        if ($post) {
            // return the view and pass in the var we previously created.
            return view('posts.edit')->withPost($post);
        } else {
            return $this->index();
        }
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        //Check if the slug has been updated or not.
        $post = Post::find($id);
        if ($request->input('slug') == $post->slug) {

            // Validate the data.
            $this->validate($request, array(
                'title' => 'required|max:255',
                'body' => 'required',
            ));
        } else {

            // Validate the data.
            $this->validate($request, array(
                'title' => 'required|max:255',
                'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'body' => 'required',
            ));
        }

        // Save the data to the database.
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->body = $request->input('body');
        $post->save();

        //Set flash data with success message.
        Session::flash('success', 'The post was successfully saved!');

        // Redirect with flash data to posts.show.
        return redirect()->route('posts.show', $post->id);

    }

    /**
     * Remove the specified post from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        // Find the post to delete.
        $post = Post::find($id);
        $post->delete();

        Session::flash('success', 'The post was successfully deleted!');
        return redirect()->route('posts.index');
    }
}
