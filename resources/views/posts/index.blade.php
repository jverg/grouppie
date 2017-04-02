
<!-- Show all the posts of each user -->

@extends('main')

@section('title', '| All posts')

@section('content')

<div class="row">
    <div class="col-md-10">

        <!-- Title of the page -->
        <h1>All Posts</h1>
    </div>

    <!-- Create new post buttons -->
    <div class="col-md-2">
        <a href="{{ route('posts.create') }}" class="btn btn-block btn-primary btn-h1-spacing">Create your own post</a>
        <a href="{{ route('crawler.create') }}" class="btn btn-block btn-primary btn-h1-spacing">Post a site</a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">

        <!-- Table with all posts -->
        <table class="table">

            <!-- Headers of the table -->
            <thead>
                <th>#</th>
                <th>Title</th>
                {{--<th>body</th>--}}
                <th>Created at</th>
                <th>Actions</th>
            </thead>

            <!-- Body of the table -->
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <th>{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        {{--<td>{{ substr(strip_tags($post->description), 0, 50) }}</td>--}}
                        <td>{{ date('M j, Y', strtotime($post->created_at)) }}</td>
                        <td>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-sm btn-info"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-default btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="text-center">
            {!! $posts->links() !!}
        </div>
    </div>
</div>

@endsection