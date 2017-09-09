
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
                            @if($user->image)
                                <img src="{{ asset('images/' . $user->image) }}" alt="" class="img-responsive" />
                            @else
                                <img src="{{ asset('images/anonymous.jpg') }}" alt="" class="img-responsive" />
                            @endif
                        </div>
                        <div class="col-sm-6 col-md-8">

                            {{-- User information --}}
                            {!! Form::model($user, array('route' => array('user.update', $user->id), 'method' => 'PATCH', 'files' => true)) !!}
                            {{-- User's name --}}
                            <p>
                                {{ Form::text('name', $user->name, array('class' => 'form-control form-spacing-top small-col')) }}
                                {{ Form::label('name', 'The name for your grouplend profile.', array('class' => 'textfield-label')) }}
                                <br>
                                <br>
                                {{ Form::file('profile_image') }}
                                {{ Form::label('profile_image', 'Upload your profile image.', array('class' => 'textfield-label')) }}
                            <hr>
                            </p>
                            <p>
                                {{-- User's facebook --}}
                                <i style="color:#3B5998" class="fa fa-facebook-official fa-2x"></i>
                                    {{ Form::text('facebook', $user->facebook, array('class' => 'form-control small-col', 'placeholder'=>'https://www.facebook.com/profilename')) }}
                                    {{ Form::label('facebook', 'Copy the link from your facebook account.', array('class' => 'textfield-label')) }}
                                <br>
                                <br>

                                {{-- User's twitter --}}
                                <i style="color:#1DA1F2" class="fa fa-twitter fa-2x"></i>
                                    {{ Form::text('twitter', $user->twitter, array('class' => 'form-control small-col', 'placeholder'=>'https://twitter.com/profilename')) }}
                                    {{ Form::label('twitter', 'Copy the link from your twitter account.', array('class' => 'textfield-label')) }}

                                <br>
                                <br>

                                {{-- User's instagram --}}
                                <i class="fa fa-instagram fa-2x"></i>
                                    {{ Form::text('instagram', $user->instagram, array('class' => 'form-control small-col', 'placeholder'=>'https://www.instagram.com/profilename')) }}
                                    {{ Form::label('instagram', 'Copy the link from your instagram account.', array('class' => 'textfield-label')) }}

                            </p><br><hr>
                                <p>
                                    {{-- User's email --}}
                                    <i style="color:#e0c633" class="fa fa-envelope fa-2x"></i>
                                        {{ Form::text('email', $user->email, array('class' => 'form-control small-col')) }}
                                        {{ Form::label('email','Your email address.', array('class' => 'textfield-label')) }}
                                    <br>
                                    <br>

                                    {{-- User's birthday date --}}
                                    <i style="color:#3B5998" class="fa fa-gift fa-2x"></i>
                                    {{ Form::text('birthday', $user->birthday, array('class' => 'form-control small-col', 'placeholder'=>'Username')) }}
                                    {{ Form::label('birthday','The date of your birth.', array('class' => 'textfield-label')) }}
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