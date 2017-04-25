
<!-- Show group users -->

@extends('main')

@section('title', '| My group')

@section('content')

    {{-- Libraries for autocomplete --}}
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <!-- Incomes sidebar -->
    {{--<div class="col-md-6">--}}
        <div class="well">
            <!-- Income element -->
            <dl class="dl-horizontal" style="text-align: center">
                <label><i class="fa fa-users fa-2x"></i></label>
                <hr>
                <!-- Table with all expenses -->
                <table class="table">

                    <!-- Headers of the table -->
                    <thead>
                    <th style="text-align: center">Username</th>
                    <th style="text-align: center">Actions</th>
                    </thead>

                    <!-- Body of the table -->
                    <tbody>
                    <tr>
                        @if($users)
                        @foreach($users as $user)
                        <td style="text-align: center">{{ $user->name }}</td>
                        <td>
                            {{ Form::open(array('method' => 'DELETE', 'route' => array('group.destroy', $user->id))) }}
                            {{ Form::hidden('id', $user->id) }}
                            {{ Form::button('<i class="fa fa-trash"></i>', array('class' => 'btn btn-danger btn-xs', 'type' => 'submit')) }}
                            {{ Form::close() }}
                        </td>
                        @endforeach
                        @endif
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align: center">
                            <a href="" class="btn btn-success btn-xs" data-toggle="modal" data-target="#addUser"><i class="fa fa-plus"></i></a>

                            <!-- Modal -->
                            <div class="modal fade" id="addUser" role="dialog">
                                <div class="modal-dialog">

                                    {{-- Content of the modal --}}
                                    <div class="well">
                                        <!-- Income element -->
                                        <dl class="dl-horizontal">
                                            <div style="text-align: center">
                                                <label><h3>Add user</h3></label>
                                            </div>

                                            <hr>
                                            {{--<!-- Create new post form -->--}}
                                        {{--{!! Form::open(array('route' => 'wallets.store', 'data-parsley-validate' => '', 'files' => true)) !!}--}}

                                        {{--<!-- Amount -->--}}
                                        {{--{{ Form::label('income_amount', 'Amount:') }}--}}
                                        {{--{{ Form::text('income_amount', null, array('class' => 'form-control')) }}--}}

                                        {{--<!-- User -->--}}
                                        {{--{{ Form::label('borrower', 'Borrower:') }}--}}
                                        {{--{{ Form::text('borrower', null, array('class' => 'typeahead form-control')) }}--}}

                                        {{--<!-- Description -->--}}
                                        {{--{{ Form::label('income_description', "Income description:", array('class' => 'form-spacing-top')) }}--}}
                                        {{--{{ Form::textarea('income_description', null, array('class' => 'form-control')) }}--}}

                                        {{--<!-- Submit button -->--}}
                                            {{--{{ Form::Submit('Create income', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px')) }}--}}
                                            {{--{!! Form::close() !!}--}}
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
    {{--</div>--}}
@endsection