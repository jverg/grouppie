
<!-- Show all the posts of each user -->

@extends('main')

@section('title', '| All posts')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div id="incomes-create" class="well">
                    <!-- Income element -->
                    <dl class="dl-horizontal" style="text-align: center">
                        <label>Incomes</label>
                        <hr>
                        <p>1500</p>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-md-offset-6">
            <div id="expenses-create" class="well">
                <!-- Income element -->
                <dl class="dl-horizontal" style="text-align: center">
                    <label>Expenses</label>
                    <hr>
                    <p>1500</p>
                </dl>
            </div>
        </div>
    </div>
@endsection