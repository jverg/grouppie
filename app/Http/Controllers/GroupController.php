<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class GroupController extends Controller {

    /*
     * Constructor fro group controller.
     */
    public function __construct() {

        /**
         * Make the group controller to be accessed
         * only from authenticated users.
        **/
        $this->middleware('auth');
    }

    /**
     * Display a listing of the group.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        // Check if the user exist in aa group.
        $groupid = Auth::user()->gid;

        if ($groupid) {

            $user = User::where('gid', $groupid)->orderBy('id', 'desc')->paginate(4);

            // Return view with user's group.
            return view('groups.index')->withUsers($user);
        } else {
            // Return create new group form.
            return redirect('group/create');
        }
    }

    /**
     * Show the form for creating a new group.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        // Check if the user exist in aa group.
        $hasgroup = Auth::user()->gid;
        if ($hasgroup) {
            // Go to user's group.
            return redirect('group');
        } else {
            // Create group form.
            return view('groups.create');
        }
    }

    /**
     * Store a newly created group in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        // Validate the group data.
        $this->validate($request, array(
            'name' => 'required|max:255',
        ));

        // Store the group in the database
        $group = new Group;
        $group->name = $request->name;
        $group->admin = Auth::user()->id;
        $group->save();

        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(array('gid' => $group->id));

        // Success message just for one request.
        Session::flash('success', 'Your group was successfully saved!');

        // Redirect to the page of the last created post.
        return redirect('/group');
    }

    /**
     * Display the specified group.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

    }

    /**
     * Show the form for editing the specified group.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

    }

    /**
     * Update the specified group in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

    }

    /**
     * Remove the specified user from grooup.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $user = User::find($id);

        $groupid = $user->gid;

        $group_users = User::where('gid', $groupid)->count();

        if ($group_users > 1) {
            // Find the user to delete.
            DB::table('users')
                ->where('id', $id)
                ->update(array('gid' => null));

            // Message when deletion took place.
            Session::flash('success', 'The user was successfully deleted from the group');
            return redirect()->route('group.index');
        } else {
            // Find the user to delete.
            DB::table('users')
                ->where('id', $id)
                ->update(array('gid' => null));

            DB::table('groups')
                ->where('id', $groupid)
                ->delete();

            // Message when deletion took place.
            Session::flash('success', 'The group has been deleted because is out of users');
            return redirect()->route('group.create');
        }
    }
}
