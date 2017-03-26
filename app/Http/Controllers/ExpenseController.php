<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class ExpenseController extends Controller {

    /**
     * ExpenseController constructor.
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

        // Brings the user's id.
        $user = Auth::id();

        // Brings the current user's expenses.
        $expenses = Expense::where('user_id', $user)->orderBy('id', 'desc')->paginate(4);

        // Brings the current user's incomes.
        $incomes = Income::where('user_id', $user)->orderBy('id', 'desc')->paginate(4);

        // Return a view and pass in the above variables.
        return view('expenses.index')
            ->withExpenses($expenses)
            ->withIncomes($incomes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        // Create expense-income form.
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
        if($request->amount || $request->lender) {
            $this->validate($request, array(
                'amount' => 'required|max:10',
                'lender' => 'required',
                'description' => 'required'
            ));
        }

        // Store the expense in the database
        $expense = new Expense;
        $expense->amount = $request->amount;
        $expense->description = $request->description;
        $expense->lender = $request->lender;
        $expense->user_id = Auth::user()->id;
        $expense->save();

        // Success message if the expense created successfully.
        Session::flash('success', 'Your expense has beed saved successfully');

        // Redirect to the page of the last created expense.
        return redirect()->route('expenses.index', $expense->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        // Brings the user's id.
        $user = Auth::id();

        // Check if the user has access to this post.
        $expense = Expense::where('user_id', $user)->find($id);

        return view('expenses.show')->withPost($expense);
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
    public function destroy($id) {

        // Find the expense to delete.
        $expense = Expense::find($id);
        $expense->delete();

        // Message when deletion took place.
        Session::flash('success', 'The expense was successfully deleted!');
        return redirect()->route('expenses.index');
    }
}
