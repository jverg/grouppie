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
                        <th style="text-align: center">Info</th>
                        <th style="text-align: center; padding-left: 8%;">Description</th>
                        <th style="text-align: center">Amount</th>
                    </thead>

                    <!-- Body of the table -->
                    <tbody>
                        @if($incomes)
                            @foreach($incomes as $income)
                                <tr>
                                    @if($income->borrower)
                                        <td style="text-align: center"><a href="/user/{{ \App\User::find($income->borrower)->id }}">{{ \App\User::find($income->borrower)->name }}</a></td>
                                        <td style="text-align: center">{{ $income->description }}</td>
                                        <td style="text-align: center">{{ $income->amount }} €</td>
                                    @else
                                        <td style="text-align: center">{{ $income->description }}</td>
                                        <td style="text-align: center"> - </td>
                                        <td style="text-align: center">{{ $income->amount }} €</td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td style="text-align: center"></td>
                            </tr>
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
                        <th style="text-align: center;">Info</th>
                        <th style="text-align: center;">Description</th>
                        <th style="text-align: center">Amount</th>
                    </thead>

                    <!-- Body of the table -->
                    <tbody>
                    @if($expenses)
                        @foreach($expenses as $expense)
                            <tr>
                                @if($expense->lender)
                                    <td style="text-align: center"><a href="/user/{{ \App\User::find($expense->lender)->id }}">{{ \App\User::find($expense->lender)->name }}</a></td>
                                    <td style="text-align: center">{{ $expense->description }}</td>
                                    <td style="text-align: center">{{ $expense->amount }} €</td>
                                @else
                                    <td style="text-align: center">{{ $expense->description }}</td>
                                    <td style="text-align: center"> - </td>
                                    <td style="text-align: center">{{ $expense->amount }} €</td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td style="text-align: center"></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </dl>
        </div>
    </div>
    <p>You must use:</p>
    <p>{{ $moneyPerDay }} €/day in order to stay alive!!</p>
@endsection