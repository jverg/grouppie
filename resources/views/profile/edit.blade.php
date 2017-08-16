
{{-- Edit profile page --}}

@extends('main')

@section('title', "| Blog" )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <img src="http://placehold.it/380x500" alt="" class="img-rounded img-responsive" />
                        </div>
                        <div class="col-sm-6 col-md-8">

                            {{-- User information --}}
                            {!! Form::model($user, array('route' => array('user.update', $user->id), 'method' => 'PATCH', 'files' => true)) !!}
                            {{-- User's name --}}
                            <p>
                                {{ Form::text('name', $user->name, array('class' => 'form-control form-spacing-top small-col')) }}
                                <br>
                                {{ Form::label('profile_image', 'Upload profile image:') }}
                                {{ Form::file('profile_image') }}
                            <hr>
                            </p>
                            <p>
                                {{-- User's facebook --}}
                                <i style="color:#3B5998" class="fa fa-facebook-official fa-2x"></i>
                                    {{ Form::text('facebook', $user->facebook, array('class' => 'form-control small-col')) }}
                                <br>

                                {{-- User's twitter --}}
                                <i style="color:#1DA1F2" class="fa fa-twitter fa-2x"></i>
                                    {{ Form::text('twitter', $user->twitter, array('class' => 'form-control small-col')) }}
                                <br>

                                {{-- User's instagram --}}
                                <i class="fa fa-instagram fa-2x"></i>
                                    {{ Form::text('instagram', $user->instagram, array('class' => 'form-control small-col')) }}
                                <br>

                                </p><br><hr>
                                <p>
                                    {{-- User's address --}}
                                    <i style="color:#ce295a" class="fa fa-map-marker fa-2x"></i>
                                        {{ Form::text('address', $user->address, array('class' => 'form-control small-col')) }}
                                    <br>

                                    {{-- User's email --}}
                                    <i style="color:#e0c633" class="fa fa-envelope fa-2x"></i>
                                        {{ Form::text('email', $user->email, array('class' => 'form-control small-col')) }}
                                    <br>

                                    {{-- User's birthday date --}}
                                    <i style="color:#3B5998" class="fa fa-gift fa-2x"></i>
                                    {{ Form::text('birthday', $user->birthday, array('class' => 'form-control small-col')) }}
                                </p>

                                <!-- Submit button -->
                                {{ Form::Submit('Save profile', array('class' => 'btn btn-success btn-md save-profile')) }}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection