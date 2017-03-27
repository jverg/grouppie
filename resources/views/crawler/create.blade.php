
<!-- Create post via crawler page -->

@extends('main')

@section('title', '| Create new crawler')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
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

    <div class="row">
        <div class="col-md-8">
            <h1>Create new post</h1>
            <hr>

            <!-- Create new post form -->
            {!! Form::open(array('route' => 'crawler.store', 'data-parsley-validate' => '', 'files' => true)) !!}

                <!-- Title -->
                {{ Form::label('url', 'URL:') }}
                {{ Form::text('url', null, array('class' => 'form-control')) }}

                <!-- Submit button -->
                {{ Form::Submit('Create post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px')) }}
            {!! Form::close() !!}

        </div>
    </div>

@endsection

<!-- Javascript library -->
@section('scripts')
    {!! Html::script('js/parsley.js') !!}}
@endsection