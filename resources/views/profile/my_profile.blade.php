
<!-- Show user's page with edit -->

@extends('main')

@section('title', "| $user->name" )

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
                            <p>

                            <h2>
                                {{ $user->name }}
                                <a href="{{ route('user.edit', Auth::id()) }}"><i class="fa fa-pencil pencil-right"></i></a>
                            </h2>
                            </p>
                            <p>
                            @if(($user->facebook) || ($user->twitter))
                                <hr>
                                <h4>Social</h4>
                                @if($user->facebook)
                                    <a style="color:#3B5998" class="btn" href="{{ $user->facebook }}" target="_blank"><i class="fa fa-facebook fa-2x"></i></a>
                                @endif
                                @if($user->twitter)
                                    <a style="color:#1DA1F2" class="btn" href="{{ $user->twitter }}" target="_blank"><i class="fa fa-twitter fa-2x"></i></a>
                                @endif
                            @endif
                            </p><hr>
                            <p>
                                <h5><i style="color:#ce295a" class="{{ $user->address ? "fa fa-map-marker fa-2x" : "" }}"></i> {{ $user->address }}</h5>
                                <h5><i style="color:#e0c633" class="{{ $user->email ? "fa fa-envelope fa-2x" : "" }}"></i>   {{ $user->email }}</h5>
                                <h5><i style="color:#3B5998" class="{{ $user->birthday ? "fa fa-gift fa-2x" : "" }}"></i> {{ $user->birthday }}</h5>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection