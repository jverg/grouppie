<!-- Show all the transactions of each user -->

@extends('main')

@section('title', '| My wallet')

@section('content')

    <!-- Incomes sidebar -->
    <div class="col-md-6">
        <div id="incomes-view" class="well">
            <!-- Income element -->
            <dl class="dl-horizontal" style="text-align: center">
                <label><i class="fa fa-smile-o fa-2x"></i></label>
                <br><br>

                <!-- Table with all expenses -->
                <table class="table">

                    <!-- Headers of the table -->
                    <thead>
                        <th style="text-align: center">From</th>
                        <th style="text-align: center">Amount</th>
                    </thead>

                    <!-- Body of the table -->
                    <tbody>
                        @if($incomes)
                            @foreach($incomes as $income)
                                <tr>
                                    <td style="text-align: center">{{ \App\User::find($income->borrower)->name }}</td>
                                    <td style="text-align: center">{{ $income->amount }} €</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </dl>
        </div>
    </div>

    <!-- Expenses sidebar -->
    <div class="col-md-6">
        <div id="expenses-view" class="well">
            <!-- Income element -->
            <dl class="dl-horizontal" style="text-align: center">
                <label><i class="fa fa-frown-o fa-2x"></i></label>
                <br><br>

                <!-- Table with all expenses -->
                <table class="table">

                    <!-- Headers of the table -->
                    <thead>
                        <th style="text-align: center; padding-left: 8%;">To</th>
                        <th style="text-align: center">Amount</th>
                    </thead>

                    <!-- Body of the table -->
                    <tbody>
                    @if($expenses)
                        @foreach($expenses as $expense)
                            <tr>
                                <td style="text-align: center">{{ \App\User::find($expense->lender)->name }}</td>
                                <td style="text-align: center">{{ $expense->amount }} €</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </dl>
        </div>
    </div>
@endsection