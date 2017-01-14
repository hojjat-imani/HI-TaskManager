@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Task
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                @include('common.errors')

                <!-- New Task Form -->
                    <form action="{{ url('task') }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Task</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control"
                                       value="{{ old('task') }}">
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Task
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            {{--@if (count($tasks) > 0)--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">--}}
                        {{--Current Tasks--}}
                    {{--</div>--}}

                    {{--<div class="panel-body">--}}

                        {{--<table class="table table-striped task-table">--}}
                        {{--<thead>--}}
                        {{--<th>Task</th>--}}
                        {{--<th>Description</th>--}}
                        {{--<th>&nbsp;</th>--}}
                        {{--</thead>--}}
                        {{--<tbody>--}}
                        {{--@foreach ($tasks as $task)--}}
                        {{----}}
                        {{--<tr>--}}
                        {{--<td class="table-text">--}}
                        {{--<div>{{ $task->name }}</div>--}}
                        {{--</td>--}}
                        {{--<td class="table-text">--}}
                        {{--<div>{{ $task->desc }}</div>--}}
                        {{--</td>--}}

                        {{--<!-- Task Delete Button -->--}}
                        {{--<td>--}}
                        {{--<form action="{{url('task/' . $task->id)}}" method="POST">--}}
                        {{--{{ csrf_field() }}--}}
                        {{--{{ method_field('DELETE') }}--}}

                        {{--<button type="submit" id="delete-task-{{ $task->id }}"--}}
                        {{--class="btn btn-danger">--}}
                        {{--<i class="fa fa-btn fa-trash"></i>Delete--}}
                        {{--</button>--}}
                        {{--</form>--}}
                        {{--</td>--}}
                        {{--</tr>--}}
                        {{--@endforeach--}}
                        {{--</tbody>--}}
                        {{--</table>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@endif--}}
        </div>

        <div class="row">
            {{--for each task list--}}
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        TaskListName and AddTaskButton
                    </div>
                    <div class="panel-body">
                        @if(count($tasks) > 0)
                            @foreach($tasks as $task)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        {{$task->name}}
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" form="editTask" name="desc" value="{{$task->desc}}">
                                            </div>
                                        </div>
                                        <form id="editTask" action="{{url('task/' . $task->id)}}" method="POST">
                                            {{csrf_field()}}
                                        </form>
                                        <form id="deleteTask" action="{{url('task/' . $task->id)}}" method="POST">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            No task yet.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
