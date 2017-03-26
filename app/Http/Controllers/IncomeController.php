<?php

namespace App\Http\Controllers;

use App\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class IncomeController extends Controller {

    /**
     * IncomeController constructor.
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
    public function index() {
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
        if($request->amount_income || $request->borrower || $request->description_income) {
            $this->validate($request, array(
                'amount_income' => 'required|max:10',
                'borrower' => 'required',
                'description_income' => 'required'
            ));
        }

        // Store in the database
        $income = new Income;
        $income->amount = $request->amount_income;
        $income->description = $request->description_income;
        $income->borrower = $request->borrower;
        $income->user_id = Auth::user()->id;
        $income->save();

        // Success message just for one request.
        Session::flash('success', 'Your income has beed saved successfully');

        // Redirect to the page of the last created post.
        return redirect()->route('incomes.show', $income->id);
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
