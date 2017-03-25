<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller {

    /**
     * PostController constructor.
     *
     * In order to only authenticate user access this.
     */
    public function __construct() {
        $this->middleware('auth');
    }

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

        // Create expense form.
        return view('expenses.create');
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
            'amount' => 'required|max:10',
            'user_id' => 'required',
            'borrower' => 'required',
        ));

        // Store in the database
        $expense = new Expense;
        $expense->amount = $request->amount;
        $expense->description = $request->description;
        $expense->borrower = Auth::user()->id;
        $expense->user_id = $request->user;
        $expense->save();

        // Success message just for one request.
        Session::flash('success', 'Your expense has beed saved successfully');

        // Redirect to the page of the last created post.
        return redirect()->route('expenses.show', $expense->id);
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
