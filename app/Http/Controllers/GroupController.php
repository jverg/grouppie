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
        $groupid = Auth::user()->group_id;

        if ($groupid) {

            $user = User::where('group_id', $groupid)->orderBy('id', 'desc')->paginate(4);
            $group = Group::find($groupid);

            // Return view with user's group.
            return view('groups.index')
                ->withUsers($user)
                ->withGroup($group);
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
        $hasgroup = Auth::user()->group_id;
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

        if ($request->username) {
            $gid = Auth::user()->group_id;

            DB::table('users')
                ->where('name', $request->username)
                ->update(array('group_id' => $gid));

            // Success message just for one request.
            Session::flash('success', 'The user added successfully!');
        }
        else {
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
                ->update(array('group_id' => $group->id));

            // Success message just for one request.
            Session::flash('success', 'Your group was successfully saved!');
        }

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

        $group_users = User::where('group_id', $groupid)->count();

        if ($group_users > 1) {
            // Find the user to delete.
            DB::table('users')
                ->where('id', $id)
                ->update(array('group_id' => null));

            // Message when deletion took place.
            Session::flash('success', 'The user was successfully deleted from the group');
            return redirect()->route('group.index');
        } else {
            // Find the user to delete.
            DB::table('users')
                ->where('id', $id)
                ->update(array('group_id' => null));

            DB::table('groups')
                ->where('id', $groupid)
                ->delete();

            // Message when deletion took place.
            Session::flash('success', 'The group has been deleted because is out of users');
            return redirect()->route('group.create');
        }
    }

    /**
     * Autocomplete for add user to group.
     */
    public function autocomplete(Request $request) {
        $data = User::select('id', 'name', 'group_id')->where("name","LIKE","%{$request->input('query')}%")->whereNull("group_id")->get();
        return response()->json($data);
    }
}
