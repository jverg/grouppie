
<!-- Show all the posts of each user -->

@extends('main')

@section('title', '| My wallet')

@section('content')

    <!-- Main page -->
    <div class="row">

        <!-- Incomes sidebar -->
        <div class="col-md-6">
            <div class="row">
                <div id="incomes-view" class="well">
                    <!-- Income element -->
                    <dl class="dl-horizontal" style="text-align: center">
                        <label><i class="fa fa-smile-o fa-2x"></i></label>
                        <hr>
                        <!-- Table with all expenses -->
                        <table class="table">

                            <!-- Headers of the table -->
                            <thead>
                                <th style="text-align: center">From</th>
                                <th style="text-align: center">Amount</th>
                                <th style="text-align: center">Actions</th>
                            </thead>

                            <!-- Body of the table -->
                            <tbody>
                            @foreach($incomes as $income)
                                <tr>
                                    <td style="text-align: center">{{ \App\User::find($income->borrower)->name }}</td>
                                    <td style="text-align: center">{{ $income->amount }} €</td>
                                    <td>
                                        {{ Form::open(array('method' => 'DELETE', 'route' => array('incomes.destroy', $income->id))) }}
                                            {{ Form::hidden('id', $income->id) }}
                                            {{ Form::button('<i class="fa fa-trash"></i>', array('class' => 'btn btn-danger btn-xs', 'type' => 'submit')) }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Expenses sidebar -->
        <div class="col-md-offset-6">
            <div class="row">
            <div id="expenses-view" class="well">
                <!-- Income element -->
                <dl class="dl-horizontal" style="text-align: center">
                    <label><i class="fa fa-frown-o fa-2x"></i></label>
                    <hr>
                    <!-- Table with all expenses -->
                    <table class="table">

                        <!-- Headers of the table -->
                        <thead>
                            <th style="text-align: center">To</th>
                            <th style="text-align: center">Amount</th>
                            <th style="text-align: center">Actions</th>
                        </thead>

                        <!-- Body of the table -->
                        <tbody>
                        @foreach($expenses as $expense)
                            <tr>
                                <td style="text-align: center">{{ \App\User::find($expense->lender)->name }}</td>
                                <td style="text-align: center">{{ $expense->amount }} €</td>
                                <td>
                                    {{ Form::open(array('method' => 'DELETE', 'route' => array('expenses.destroy', $expense->id))) }}
                                        {{ Form::hidden('id', $expense->id) }}
                                        {{ Form::button('<i class="fa fa-trash"></i>', array('class' => 'btn btn-danger btn-xs', 'type' => 'submit')) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </dl>
            </div>
            </div>
        </div>
    </div>
@endsection