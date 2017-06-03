
<!-- Show group users -->

@extends('main')

@section('title', '| My group')

@section('content')

    {{-- Libraries for autocomplete --}}
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <!-- Users of the group -->
    <div class="well">
        <!-- Income element -->
        <dl class="dl-horizontal" style="text-align: center">
            <label>{{ $group->name }}</label><br>
            <label><i class="fa fa-users fa-2x"></i></label>
            <hr>
            <!-- Table with all users of the group -->
            <table class="table">

                <!-- Headers of the table -->
                <thead>
                    <th style="text-align: center">Username</th>
                    @if(Auth::user()->id == $group->admin)
                    <th style="text-align: center">Actions</th>
                    @endif
                </thead>

                <!-- Body of the table -->
                <tbody>
                @if($users)
                    @foreach($users as $user)
                    <tr>
                        @if($user->id  ==  $group->admin)
                            <td style="text-align: center">{{ $user->name }} (admin)</td>
                        @else
                        <td style="text-align: center"><a href="/user/{{ $user->id }}">{{ $user->name }}</a></td>
                        @endif

                        @if(Auth::user()->id == $group->admin)
                            <td>
                                {{ Form::open(array('method' => 'DELETE', 'route' => array('group.destroy', $user->id))) }}
                                {{ Form::hidden('id', $user->id) }}
                                {{ Form::button('<i class="fa fa-trash"></i>', array('class' => 'btn btn-danger btn-xs', 'type' => 'submit')) }}
                                {{ Form::close() }}
                            </td>
                        @endif
                    </tr>
                    @endforeach
                @endif
                @if(Auth::user()->id == $group->admin)
                    <tr>
                        <td></td>
                        <td style="text-align: center">
                            <a href="" class="btn btn-success btn-xs" data-toggle="modal" data-target="#addUser"><i class="fa fa-plus"></i></a>

                            <!-- Modal -->
                            <div class="modal fade" id="addUser" role="dialog">
                                <div class="modal-dialog">

                                    {{-- Content of the modal --}}
                                    <div class="well">
                                        <!-- Income element -->
                                        <dl class="dl-horizontal">
                                            <div style="text-align: center">
                                                <label><h3>Add user</h3></label>
                                            </div>

                                            <hr>
                                            <!-- Create new post form -->
                                            {!! Form::open(array('route' => 'group.store', 'data-parsley-validate' => '')) !!}

                                            <!-- Amount -->
                                            {{ Form::label('username', 'Username:') }}
                                            {{ Form::text('username', null, array('class' => 'typeahead form-control')) }}

                                            <!-- Submit button -->
                                            {{ Form::Submit('Add user', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px')) }}
                                            {!! Form::close() !!}
                                        </dl>
                                    </div>

                                </div>
                            </div>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </dl>
    </div>

    {{-- Script for autocomplete --}}
    <script type="text/javascript">
        var path = "{{ route('autocompletegroup') }}";
        $('input.typeahead').typeahead({
            source: function (query, process) {
                return $.get(path, {query: query}, function (data) {
                    return process(data);
                });
            }
        });
    </script>
@endsection