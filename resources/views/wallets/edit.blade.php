
<!-- Edit a post -->

@extends('main')

@section('title', '| Edit post')

@section('stylesheets')

    {{-- Editor's script --}}
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'link code',
            menubar: false,
        });
    </script>
@endsection

@section('content')

    <!-- Main content -->
    <div class="row">
        <div class="col-md-8">
        {!! Form::model($post, array('route' => array('posts.update', $post->id), 'method' => 'PATCH')) !!}

            <!-- Edit post title -->
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title', null, array('class' => 'form-control input-lg')) }}

            <!-- Edit post body -->
            {{ Form::label('description', 'Description:', array('class' => 'form-spacing-top')) }}
            {{ Form::textarea('description', null, array('class' => 'form-control')) }}
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <div class="well">

                <!-- Created at element -->
                <dl class="dl-horizontal">
                    <label>Created at:</label>
                    <p>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</p>
                </dl>

                <!-- Updated at element -->
                <dl class="dl-horizontal">
                    <label>Updated at:</label>
                    <p>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</p>
                </dl>
                <hr>

                <!-- Cancel and Save buttons -->
                <div class="row">

                    <!-- Cancel button -->
                    <div class="col-sm-6">
                        {!! Html::linkRoute('posts.show', '', array($post->id), array('class' => 'btn btn-danger btn-block fa fa-ban fa-2x')) !!}
                    </div>

                    <!-- Save button -->
                    <div class="col-sm-6">
                        {{ Form::button('<i class="fa fa-save fa-2x"></i>', array('type' => 'submit', 'class' => 'btn btn-success btn-block')) }}
                    </div>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </div>

@endsection
