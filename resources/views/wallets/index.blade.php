<!-- Show all the transactions of each user -->

@extends('main')

@section('title', '| My wallet')

@section('content')

    {{-- Libraries for autocomplete --}}
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <!-- Incomes sidebar -->
    <div class="col-md-6">
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
                                    <td style="text-align: center"><a href="/user/{{ \App\User::find($income->borrower)->id }}">{{ \App\User::find($income->borrower)->name }}</a></td>
                                    <td style="text-align: center">{{ $income->amount }} €</td>
                                    <td>
                                        {{ Form::open(array('method' => 'DELETE', 'route' => array('wallets.destroy', $income->id))) }}
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
                                            {!! Form::open(array('route' => 'wallets.store', 'data-parsley-validate' => '', 'files' => true)) !!}

                                            <!-- Amount -->
                                            {{ Form::label('income_amount', 'Amount:') }}
                                            {{ Form::text('income_amount', null, array('class' => 'form-control')) }}

                                            <!-- User -->
                                            {{ Form::label('borrower', 'Borrower:') }}
                                            {{ Form::text('borrower', null, array('class' => 'typeahead form-control')) }}

                                            <!-- Description -->
                                            {{ Form::label('income_description', "Income description:", array('class' => 'form-spacing-top')) }}
                                            {{ Form::textarea('income_description', null, array('class' => 'form-control')) }}

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

    <!-- Expenses sidebar -->
    <div class="col-md-6">
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
                                <td style="text-align: center"><a href="/user/{{ \App\User::find($expense->lender)->id }}">{{ \App\User::find($expense->lender)->name }}</a></td>
                                <td style="text-align: center">{{ $expense->amount }} €</td>
                                <td>
                                    {{ Form::open(array('method' => 'DELETE', 'route' => array('wallets.destroy', $expense->id))) }}
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
                                            {!! Form::open(array('route' => 'wallets.store', 'data-parsley-validate' => '', 'files' => true)) !!}

                                            <!-- Amount -->
                                            {{ Form::label('expense_amount', 'Amount:') }}
                                            {{ Form::text('expense_amount', null, array('class' => 'form-control')) }}
                                            <!-- User -->
                                            {{ Form::label('lender', 'Lender:') }}
                                            {{ Form::text('lender', null, array('class' => 'typeahead form-control')) }}
                                            <!-- Description -->
                                            {{ Form::label('expense_description', "Expense description:", array('class' => 'form-spacing-top')) }}
                                            {{ Form::textarea('expense_description', null, array('class' => 'form-control')) }}
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

    {{-- Script for autocomplete --}}
    <script type="text/javascript">
        var path = "{{ route('autocomplete') }}";
        $('input.typeahead').typeahead({
            source:  function (query, process) {
                return $.get(path, { query: query }, function (data) {
                    return process(data);
                });
            }
        });
    </script>
@endsection