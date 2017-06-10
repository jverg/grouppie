<!-- Show all the posts of each user -->

@extends('main')

@section('title', '| My wallet')

@section('content')

    <div class="col-md-6">
        <div id="incomes-create" class="well">
            <!-- Income element -->
            <dl class="dl-horizontal">
                <div style="text-align: center">
                    <label>Incomes</label>
                </div>

                <hr>
                <!-- Create new post form -->
                {!! Form::open(array('route' => 'transactions.store', 'data-parsley-validate' => '', 'files' => true)) !!}

                <!-- Amount -->
                {{ Form::label('income_amount', 'Amount:') }}
                {{ Form::text('income_amount', null, array('class' => 'form-control')) }}

                <!-- User -->
                {{ Form::label('borrower', 'Borrower:') }}
                {{ Form::text('borrower', null, array('class' => 'form-control')) }}

                <!-- Description -->
                {{ Form::label('income_description', "Income description:", array('class' => 'form-spacing-top')) }}
                {{ Form::textarea('income_description', null, array('class' => 'form-control')) }}

                <!-- Submit button -->
                {{ Form::Submit('Create income', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px')) }}
                {!! Form::close() !!}
            </dl>
        </div>
    </div>
    <div class="col-md-6">
        <div id="expenses-create" class="well">
            <!-- Income element -->
            <dl class="dl-horizontal">
                <div style="text-align: center">
                    <label>Expenses</label>
                </div>
                <hr>
                    <!-- Create new post form -->
                    {!! Form::open(array('route' => 'transactions.store', 'data-parsley-validate' => '', 'files' => true)) !!}

                    <!-- Amount -->
                    {{ Form::label('expense_amount', 'Amount:') }}
                    {{ Form::text('expense_amount', null, array('class' => 'form-control')) }}

                    <!-- User -->
                    {{ Form::label('lender', 'Lender:') }}
                    {{ Form::text('lender', null, array('class' => 'form-control')) }}

                    <!-- Description -->
                    {{ Form::label('expense_description', "Expense description:", array('class' => 'form-spacing-top')) }}
                    {{ Form::textarea('expense_description', null, array('class' => 'form-control')) }}

                    <!-- Submit button -->
                    {{ Form::Submit('Create expense', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px')) }}
                    {!! Form::close() !!}
            </dl>
        </div>
    </div>
@endsection