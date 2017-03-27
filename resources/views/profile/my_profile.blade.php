
<!-- Show user's page -->

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

                            {{-- User's name --}}
                            <h2>
                                @if (\Illuminate\Support\Facades\Auth::id() == $user->id)
                                    <a href="{{ route('user.edit', Auth::id()) }}"><i class="fa fa-pencil"></i></a>
                                @endif
                                {{ $user->name }}
                            </h2>
                            </p>
                            <p>

                            {{-- User's social --}}
                            @if(($user->facebook) || ($user->twitter))
                                <hr>
                                <h4>Social</h4>

                                {{-- User's facebook --}}
                                @if($user->facebook)
                                    <a style="color:#3B5998" class="btn" href="{{ $user->facebook }}" target="_blank"><i class="fa fa-facebook fa-2x"></i></a>
                                @endif

                                {{-- User's twitter --}}
                                @if($user->twitter)
                                    <a style="color:#1DA1F2" class="btn" href="{{ $user->twitter }}" target="_blank"><i class="fa fa-twitter fa-2x"></i></a>
                                @endif
                            @endif
                            </p><hr>
                            <p>
                                {{-- User's address --}}
                                <h5><i style="color:#ce295a" class="{{ $user->address ? "fa fa-map-marker fa-2x" : "" }}"></i> {{ $user->address }}</h5>

                               {{-- User's email --}}
                               <h5><i style="color:#e0c633" class="{{ $user->email ? "fa fa-envelope fa-2x" : "" }}"></i>   {{ $user->email }}</h5>

                                {{-- User's birthday --}}
                                <h5><i style="color:#3B5998" class="{{ $user->birthday ? "fa fa-gift fa-2x" : "" }}"></i> {{ $user->birthday }}</h5>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
