
<!-- Show welcome page -->

@extends('main')

@section('title', "| Blog" )

@section('content')

    <!-- Main body of each post -->
    @foreach($posts as $post)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>{{ $post->title }}</h2>

                <!-- Link to author's profile -->
                <h4><span class="fa fa-user"></span>
                    <a href="{{ route('user.show', \App\User::find($post->user_id)->id) }}">
                        {{ \App\User::find($post->user_id)->name }}
                    </a>{{ ' - ' . date('M j, Y', strtotime($post->created_at)) }}
                </h4>
                <p>{{ substr(strip_tags($post->body), 0, 250) }}</p><br>
                <h5>Comments:<small> {{ $post->comments()->count() }}</small></h5>

                <!-- Read more button -->
                <a href="{{ route('blog.single', $post->slug) }}" class="btn btn-primary">Read more</a>
                <hr>
            </div>
        </div>
    @endforeach

    <!-- Pagination -->
    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>

@endsection
