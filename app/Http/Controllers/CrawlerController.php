<?php

namespace App\Http\Controllers;

use App\Post;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Weidner\Goutte\GoutteFacade;

class CrawlerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // Create post form.
        return view('crawler.create');
    }

    /**
     * Store a newly created post in storage with crawler.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        // URL for the crawler.
        $url = $request->url;

        // Get all the content from the URL that are needed.
        $content = GoutteFacade::request('GET', $url);
        $title = $content->filter('meta[property="og:title"]')->attr('content');
        $description = $content->filter('meta[property="og:description"]')->attr('content');
        $image = $content->filter('meta[property="og:image"]')->attr('content');
        $url = $content->filter('meta[property="og:url"]')->attr('content');

        // Store in the database
        $crawler = new Post;
        $crawler->title = $title;
        $crawler->description = $description;
        $crawler->img_url = $image;
        $crawler->url = $url;
        $crawler->user_id = Auth::user()->id;
        $crawler->save();

        // Success message just for one request.
        Session::flash('success', 'Your post was successfully created!');

        // Redirect to the page of the last created post.
        return redirect()->route('posts.show', $crawler->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
