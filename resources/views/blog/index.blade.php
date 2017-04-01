
<!-- Home page -->

@extends('main')

@section('title', "| Groupie" )

@section('content')

    <!-- Main page -->
    <div class="row">

        <!-- Incomes sidebar -->
        <div class="col-md-2">
            <div class="row">
                <div id="incomes-sidebar" class="well">
                    <dl class="dl-horizontal" style="text-align: center">
                        <label><i class="fa fa-smile-o fa-2x"></i></label>
                        <hr>

                        <!-- Table with all incomes -->
                        <table class="table">
                            <!-- Headers of the table -->
                            <thead>
                            <th style="text-align: center">From</th>
                            <th style="text-align: center">Amount</th>
                            </thead>

                            <!-- Body of the table -->
                            <tbody>
                            @foreach($incomes as $income)
                                <tr>
                                    <td style="text-align: center">{{ \App\User::find($income->borrower)->name }}</td>
                                    <td style="text-align: center">{{ $income->amount }} €</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Expenses sidebar -->
        <div class="col-md-offset-2">
            <div id="expenses-sidebar" class="well">
                <dl class="dl-horizontal" style="text-align: center">
                    <label><i class="fa fa-frown-o fa-2x"></i></label>
                    <hr>
                    <!-- Table with all expenses -->
                    <table class="table">

                        <!-- Headers of the table -->
                        <thead>
                        <th style="text-align: center">To</th>
                        <th style="text-align: center">Amount</th>
                        </thead>

                        <!-- Body of the table -->
                        <tbody>
                        @foreach($expenses as $expense)
                            <tr>
                                <td style="text-align: center">{{ \App\User::find($expense->lender)->name }}</td>
                                <td style="text-align: center">{{ $expense->amount }} €</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </dl>
            </div>
        </div>

        {{-- Main element with the posts --}}
        <div class="col-md-6 col-md-offset-3" style="text-align: center">
            @foreach($posts as $post)
                <h2>{{ $post->title }}</h2>
                <!-- Link to author's profile -->
                <h4><span class="fa fa-user"></span>
                    <a href="{{ route('user.show', \App\User::find($post->user_id)->id) }}">
                        {{ \App\User::find($post->user_id)->name }}
                   </a> {{--{{ ' - ' . date('M j, Y', strtotime($post->created_at)) }}--}}
                </h4>
                <br>
                {{-- Image of each post --}}
                @if ($post->img_url)
                    <img src="{{ $post->img_url }}" width="50%" height="60%">
                @elseif($post->image)
                    <img src="{{ asset('post_images/' . $post->image) }}" width="50%" height="60%">
                @endif
                <!-- Main content of the post -->
                <br><br>
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

            <!-- Pagination -->
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        {!! $posts->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
