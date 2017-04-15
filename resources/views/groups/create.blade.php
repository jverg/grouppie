
<!-- Create group page -->

@extends('main')

@section('title', '| Create your group')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create your new group</div>
                    <div class="panel-body">
                        <!-- Create new post form -->
                        {!! Form::open(array('route' => 'group.store', 'data-parsley-validate' => '')) !!}

                        <!-- Name -->
                        {{ Form::label('name', 'Name:') }}
                        {{ Form::text('name', null, array('class' => 'form-control')) }}

                        <!-- Submit button -->
                        {{ Form::Submit('Create group', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px')) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
