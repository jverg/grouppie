<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller {

    /**
     * TransactionController constructor.
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
        $expenses = Transaction::where('borrower', $user)->orderBy('id', 'desc')->paginate(4);

        // Brings the current user's incomes.
        $incomes = Transaction::where('lender', $user)->orderBy('id', 'desc')->paginate(4);

        // Return a view and pass in the above variables.
        return view('transactions.index')
            ->withExpenses($expenses)
            ->withIncomes($incomes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        // Create wallet form.
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        // Brings the user's gid.
        $group_id = Auth::user();
        $group_id = $group_id['group_id'];

        // Validate the data.
        if($request->expense_amount || $request->lender || $request->expense_description) {
            $this->validate($request, array(
                'expense_amount' => 'required|max:10',
                'expense_description' => 'required'
            ));

            // Brings the user that is got from the request.
            $lender = User::select('id')->where('name', $request->lender)->first();
            $lender_id = $lender['id'];

            // Store the expense in the database
            $expense = new Transaction;
            $expense->amount = $request->expense_amount;
            $expense->description = $request->expense_description;
            $expense->lender = $lender_id;
            $expense->borrower = Auth::user()->id;
            $expense->save();

            // Success message if the expense created successfully.
            Session::flash('success', 'Your expense has been saved successfully');

            // Redirect to the page of the last created expense.
            return redirect()->route('transactions.index', $expense->id);
        } elseif ($request->income_amount || $request->borrower || $request->income_description) {
            $this->validate($request, array(
                'income_amount' => 'required|max:10',
                'income_description' => 'required'
            ));

            // Brings the user that is got from the request.
            $borrower = User::select('id')->where('name', $request->borrower)->first();
            $borrower_id = $borrower['id'];

            // Store the transaction in the database
            $income = new Transaction;
            $income->amount = $request->income_amount;
            $income->description = $request->income_description;
            $income->borrower = $borrower_id;
            $income->lender = Auth::user()->id;
            $income->save();

            // Success message just for one request.
            Session::flash('success', 'Your income has beed saved successfully');

            // Redirect to the page of the last created expense.
            return redirect()->route('transactions.index', $income->id);
        }
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
    public function destroy($id) {

        // Find the income to delete.
        $expense = Transaction::find($id);
        $expense->delete();

        // Message when deletion took place.
        Session::flash('success', 'The transaction was successfully deleted!');
        return redirect()->route('transactions.index');
    }

    public function transactions() {
        // Brings the user's id.
        $user = Auth::id();

        // Brings the current user's expenses.
        $expenses = Transaction::where('borrower', $user)->orderBy('id', 'desc')->paginate(4);

        // Brings the current user's incomes.
        $incomes = Transaction::where('lender', $user)->orderBy('id', 'desc')->paginate(4);

        // Return a view and pass in the above variables.
        return view('transactions.transactions')
            ->withExpenses($expenses)
            ->withIncomes($incomes);
    }
}
