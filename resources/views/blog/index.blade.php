
<!-- Home page -->

@extends('main')

@section('title', "| Blog" )

@section('content')

    <!-- Main page -->
    <div class="row">

        <!-- Main body of each post -->
        <div class="col-md-12">

            <!-- Income sidebar -->
            <div class="col-md-3">
                <div class="well" style="background-color: lightgreen;height: 400px;">
                    <!-- Income element -->
                    <dl class="dl-horizontal">
                        <label>Income</label>
                        <p>1500</p>
                    </dl>
                </div>
            </div>


            <div class="col-md-6" style="text-align: center">
                @foreach($posts as $post)
                <h2>{{ $post->title }}</h2>

                <!-- Link to author's profile -->
                <h4><span class="fa fa-user"></span>
                    <a href="{{ route('user.show', \App\User::find($post->user_id)->id) }}">
                        {{ \App\User::find($post->user_id)->name }}
                    </a>{{ ' - ' . date('M j, Y', strtotime($post->created_at)) }}
                </h4>

                {{-- Image of each post --}}
                @if ($post->img_url)
                    <img src="{{ $post->img_url }}" width="40%" height="40%">
                @elseif($post->image)
                    <img src="{{ asset('post_images/' . $post->image) }}" width="40%" height="40%">
                @endif

                <!-- Main content of the post -->
                <p>{{ strip_tags($post->description) }}</p><br>

                <!-- Comments -->
                <h5>Comments:<small> {{ $post->comments()->count() }}</small></h5>

                <!-- If it is from crawler show "Go to site" button -->
                @if($post->url)
                    <a href="{{ $post->url }}" class="btn btn-primary" target="_blank">Go to site</a>
                @endif

                <!-- Read more button -->
                <a href="{{ route('blog.single', $post->id) }}" class="btn btn-primary">Read more</a>
                    <hr style="border-color: darkslategray">
                @endforeach
            </div>

            <!-- Income sidebar -->
            <div class="col-md-offset-9">
                <div class="well" style="background-color: lightsalmon; height: 400px;">
                    <!-- Income element -->
                    <dl class="dl-horizontal">
                        <label>Expenses</label>
                        <p>1500</p>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>

@endsection
