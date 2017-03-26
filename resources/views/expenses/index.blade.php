
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
                            @if($incomes)
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
                            @endif
                            <tr>
                                <td></td>
                                <td></td>
                                <td style="text-align: center">
                                    <a href="" class="btn btn-success btn-xs" data-toggle="modal" data-target="#createIncome"><i class="fa fa-plus"></i></a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="createIncome" role="dialog">
                                        <div class="modal-dialog">

                                            {{-- Content of the modal --}}
                                            <div id="incomes-create" class="well">
                                                <!-- Income element -->
                                                <dl class="dl-horizontal">
                                                    <div style="text-align: center">
                                                        <label><h3>Income</h3></label>
                                                    </div>

                                                    <hr>
                                                    <!-- Create new post form -->
                                                    {!! Form::open(array('route' => 'incomes.store', 'data-parsley-validate' => '', 'files' => true)) !!}

                                                        <!-- Amount -->
                                                        {{ Form::label('amount_income', 'Amount:') }}
                                                        {{ Form::text('amount_income', null, array('class' => 'form-control')) }}

                                                        <!-- User -->
                                                        {{ Form::label('borrower', 'Borrower:') }}
                                                        {{ Form::text('borrower', null, array('class' => 'form-control')) }}

                                                        <!-- Description -->
                                                        {{ Form::label('description_income', "Income description:", array('class' => 'form-spacing-top')) }}
                                                        {{ Form::textarea('description_income', null, array('class' => 'form-control')) }}

                                                        <!-- Submit button -->
                                                        {{ Form::Submit('Create income', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px')) }}
                                                    {!! Form::close() !!}
                                                </dl>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Expenses sidebar -->
        <div class="col-md-offset-6">
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
                        @if($expenses)
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
                        @endif
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="text-align: center">
                                <a href="" class="btn btn-success btn-xs" data-toggle="modal" data-target="#createExpense"><i class="fa fa-plus"></i></a>

                                <!-- Modal -->
                                <div class="modal fade" id="createExpense" role="dialog">
                                    <div class="modal-dialog">

                                        {{-- Content of the modal --}}
                                        <div id="expenses-create" class="well">
                                            <!-- Income element -->
                                            <dl class="dl-horizontal">

                                                <div style="text-align: center">
                                                    <label><h3>Expense</h3></label>
                                                </div>

                                                <hr>
                                                <!-- Create new post form -->
                                                {!! Form::open(array('route' => 'expenses.store', 'data-parsley-validate' => '', 'files' => true)) !!}

                                                    <!-- Amount -->
                                                    {{ Form::label('amount', 'Amount:') }}
                                                    {{ Form::text('amount', null, array('class' => 'form-control')) }}

                                                    <!-- User -->
                                                    {{ Form::label('lender', 'Lender:') }}
                                                    {{ Form::text('lender', null, array('class' => 'form-control')) }}

                                                    <!-- Description -->
                                                    {{ Form::label('description', "Expense description:", array('class' => 'form-spacing-top')) }}
                                                    {{ Form::textarea('description', null, array('class' => 'form-control')) }}

                                                    <!-- Submit button -->
                                                    {{ Form::Submit('Create expense', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px')) }}
                                                {!! Form::close() !!}
                                            </dl>
                                        </div>

                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </dl>
            </div>
        </div>
    </div>
@endsection