
<!-- Show a post for all users -->

@extends('main')

@section('title', "| $post->title" )

@section('content')

<!-- Main content of the post -->
<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <h1>{{ $post->title }}</h1><br>
        <h4><span class="fa fa-user"></span>
        <a href="{{ route('user.show', \App\User::find($post->user_id)->id) }}">
            {{ \App\User::find($post->user_id)->name }}
        </a>{{ ' - ' . date('M j, Y', strtotime($post->created_at)) }}
        </h4>

        @if ($post->img_url)
            <img src="{{ $post->img_url}}" width="200" height="200">
        @elseif($post->image)
            <img src="{{ asset('post_images/' . $post->image) }}" width="200" height="200">
        @endif

        <p>{!! $post->description !!}</p><br><br>
    </div>
</div>

<!-- COMMENTS -->
@foreach($post->comments as $comment)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table">

                <!-- Username of the comment -->
                <thead>
                <th><span class="fa fa-user"></span>{{ ' ' . $comment->name }}</th>
                </thead>

                <!-- Body of the comment -->
                <tbody>
                <tr>
                    <td>{{ $comment->comment }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div><br>
@endforeach

<!-- Form that create comments -->
<div class="row">
    <div id="comment-form" class="col-md-8 col-md-offset-2" style="margin-top: 50px">
        {{ Form::open(array('route' => array('comments.store', $post->id), 'method' => 'POST')) }}
        <div class="row">
            <!-- The name of the user that creates the comment -->
            <div class="col-md-6">
                {{ Form::label('name', 'Name:') }}
                {{ Request::is('/') ? "active" : "" }}
                {{ Form::text('name', Auth::user() ? Auth::user()->name : 'Anonymous', array('class' => 'form-control', 'disabled' => 'disabled')) }}
            </div>

            <!-- Tha body of the comment -->
            <div class="col-md-12">
                {{ Form::label('comment'), 'Comment:' }}
                {{ Form::textarea('comment', null, array('class' => 'form-control', 'rows' => '5')) }}
                {{ Form::submit('Add comment', array('class' => 'btn btn-success btn-block btn-h1-spacing')) }}
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>

@endsection
