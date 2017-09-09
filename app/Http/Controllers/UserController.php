<?php

namespace App\Http\Controllers;

use App\User;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        // Return the logged in User.
        $user = Auth::user();

        // Return the user's Profile.
        return view('profile.my_profile')->withUser($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        // Validate the data.
        $this->validate($request, array(
            'name' => 'required',
            'email' => 'required',
        ));

        // Store in the database
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->facebook = $request->facebook->null;
        $user->twitter = $request->twitter->null;
        $user->instagram = $request->instagram->null;
        $user->address = $request->address->null;
        $user->birthday = $request->birthday->null;
        $user->save();

        // Success message just for one request.
        Session::flash('success', 'The user was successfully save!');

        // Redirect to the page of the last created post.
        return view('profile.my_profile')->withUser($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        // Return the User according his id.
        $user = User::find($id);

        // Return the user's Profile.
        return view('profile.my_profile')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        // Return the User according his id.
        $user = User::find($id);

        // Check if is current user's view.
        if ($user->id == Auth::id()) {
            // Return the user's Profile.
            return view('profile.edit')->withUser($user);
        } else {
            // If the user have no access redirect to home page.
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

        // Return the User according his id.
        $user = User::find($id);

        // Validate the data.
        $this->validate($request, array(
            'name' => 'required',
            'email' => 'required',
        ));

        // Store the user in the database
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $facebookUrl = 'https://www.facebook.com/';
        $twitterUrl = 'https://twitter.com/';
        $instagramUrl = 'https://www.instagram.com/';

        if ((substr( $request->input('facebook'), 0, 25 ) === $facebookUrl) == false && $request->input('facebook') != NULL) {

            // Failed.
            Session::flash('warning', 'The facebook link does not exist');

            // Redirect to the page of the last created post.
            return view('profile.edit')->withUser($user);
        } elseif ((substr( $request->input('twitter'), 0, 20 ) === $twitterUrl) == false && $request->input('twitter') != NULL) {

            // Failed.
            Session::flash('warning', 'The twitter link does not exist');

            // Redirect to the page of the last created post.
            return view('profile.edit')->withUser($user);
        } elseif ((substr( $request->input('instagram'), 0, 26 ) === $instagramUrl) == false && $request->input('instagram') != NULL) {

            // Failed.
            Session::flash('warning', 'The instagram link does not exist');

            // Redirect to the page of the last created post.
            return view('profile.edit')->withUser($user);
        } else {

            $user->facebook = $request->input('facebook');
            $user->twitter = $request->input('twitter');
            $user->instagram = $request->input('instagram');
            $user->address = $request->input('address');

            $birthday = strtotime($request->input('birthday'));
            $user->birthday = date('Y-m-d', $birthday);

            // Save profile image.
            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $filename = time() . '-' . $user->id . '.' . $image->getClientOriginalExtension();
                $location = public_path('images/' . $filename);
                Image::make($image)->resize(500, 500)->save($location);

                $user->image = $filename;
            }

            $user->save();

            // Success message just for one request.
            Session::flash('success', 'Your profile has been successfully updated!');

            // Redirect to the page of the last created post.
            return view('profile.my_profile')->withUser($user);
        }
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
