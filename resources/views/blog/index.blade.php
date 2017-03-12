
<!-- Home page -->

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

                {{-- Image of each post --}}
                @if ($post->img_url)
                    <img src="{{ $post->img_url }}" width="150" height="150">
                @elseif($post->image)
                    <img src="{{ asset('post_images/' . $post->image) }}" width="150" height="150">
                @endif

                <!-- Main content of the post -->
                <p>{{ strip_tags($post->description) }}</p><br>

                <!-- Comments -->
                <h5>Comments:<small> {{ $post->comments()->count() }}</small></h5>

                <!-- Read more button -->
                @if($post->url)
                    <a href="{{ $post->url }}" class="btn btn-primary" target="_blank">Read more</a>
                @else
                    <a href="{{ route('blog.single', $post->id) }}" class="btn btn-primary">Read more</a>
                @endif
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
