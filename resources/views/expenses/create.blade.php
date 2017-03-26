
<!-- Show all the posts of each user -->

@extends('main')

@section('title', '| My wallet')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div id="incomes-create" class="well">
                    <!-- Income element -->
                    <dl class="dl-horizontal">
                        <div style="text-align: center">
                            <label>Incomes</label>
                        </div>

                        <hr>
                        <!-- Create new post form -->
                        {!! Form::open(array('route' => 'expenses.store', 'data-parsley-validate' => '', 'files' => true)) !!}

                            <!-- Amount -->
                            {{ Form::label('amount', 'Amount:') }}
                            {{ Form::text('amount', null, array('class' => 'form-control')) }}

                            <!-- User -->
                            {{ Form::label('user_id', 'Borrower:') }}
                            {{ Form::text('user_id', null, array('class' => 'form-control')) }}

                            <!-- Description -->
                            {{ Form::label('description', "Income description:", array('class' => 'form-spacing-top')) }}
                            {{ Form::textarea('description', null, array('class' => 'form-control')) }}

                            <!-- Submit button -->
                            {{ Form::Submit('Create income', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px')) }}
                        {!! Form::close() !!}
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-md-offset-6">
            <div id="expenses-create" class="well">
                <!-- Income element -->
                <dl class="dl-horizontal">

                    <div style="text-align: center">
                        <label>Expenses</label>
                    </div>

                    <hr>
                    <!-- Create new post form -->
                    {!! Form::open(array('route' => 'expenses.store', 'data-parsley-validate' => '', 'files' => true)) !!}

                        <!-- Amount -->
                        {{ Form::label('amount', 'Amount:') }}
                        {{ Form::text('amount', null, array('class' => 'form-control')) }}

                        <!-- User -->
                        {{ Form::label('user_id', 'Lender:') }}
                        {{ Form::text('user_id', null, array('class' => 'form-control')) }}

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
@endsection