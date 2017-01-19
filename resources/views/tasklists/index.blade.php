@extends('layouts.app')

@section('content')
    <div class="container-fluid container-scroll">
        <div class="row">
            <div class="col-sm-12">
                <!-- Display Validation Errors -->
            @include('common.errors')

            <!-- New Task Form -->
                <form action="{{ url('tasklists') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}

                <!-- Task Name -->
                    <div class="form-group">
                        <label for="tasklist-name" class="col-sm-3 control-label">Task List</label>

                        <div class="col-sm-6">
                            <input type="text" name="name" id="tasklist-name" class="form-control"
                                   value="{{ old('task') }}">
                        </div>
                    </div>

                    <!-- Add Task Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-btn fa-plus"></i>Add Task List
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <br/>
            @if(count($tasklists) > 0)
                @foreach($tasklists as $tasklist)
                    <div class="col col-lg-4 col-md-4 col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                {{$tasklist->name}}
                            </div>
                            <div class="panel-body">
                                @if(count($tasks) > 0)
                                    @foreach($tasks as $task)
                                        @if($tasklist->id == $task->tasklist_id)
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <p class="text-primary">{{$task->name}}</p>
                                                    <p style="padding: 1rem">{{$task->desc}}</p>
                                                    {{--<div class="row">--}}
                                                    {{--<div class="col-sm-12">--}}
                                                    {{--<input type="text" form="editTask" name="desc" value="{{$task->desc}}">--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<form id="editTask" action="{{url('task/' . $task->id)}}" method="POST">--}}
                                                    {{--{{csrf_field()}}--}}
                                                    {{--</form>--}}
                                                    {{--<form id="deleteTask" action="{{url('task/' . $task->id)}}" method="POST">--}}
                                                    {{--{{csrf_field()}}--}}
                                                    {{--{{method_field('DELETE')}}--}}
                                                    {{--</form>--}}
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                <div class="text-center">
                                    <!-- Trigger the modal with a button -->
                                    <button type="button" class="btn btn-default" data-toggle="modal"
                                            data-target="#addTaskModal"><i class="fa fa-btn fa-plus"></i>New Task
                                    </button>

                                    <!-- Modal -->
                                    <div id="addTaskModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">New Task</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- New Task Form -->
                                                    <form action="{{ url('task') }}" method="POST"
                                                          class="form-horizontal">
                                                        {{ csrf_field() }}

                                                        <div class="form-group">
                                                            <label for="task-name"
                                                                   class="col-sm-2 control-label text-center">Task
                                                                Name</label>

                                                            <div class="col-sm-10">
                                                                <input type="text" name="name" id="task-name"
                                                                       class="form-control"
                                                                       value=" ">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="task-desc"
                                                                   class="col-sm-2 control-label text-center">Description</label>

                                                            <div class="col-sm-10">
                                                                <input type="text" name="desc" id="task-desc"
                                                                       class="form-control"
                                                                       value=" ">
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="tasklist_id"
                                                               value="{{$tasklist->id}}">

                                                        <!-- Add Task Button -->
                                                        <div class="form-group">
                                                            <div class="col-sm-offset-3 col-sm-6">
                                                                <button type="submit" class="btn btn-default">
                                                                    <i class="fa fa-btn fa-plus"></i>Add Task List
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                No task list yet.
            @endif



            {{--<div class="col col-lg-4 col-md-4 col-sm-6">--}}
            {{--<div class="panel panel-default">--}}
            {{--<div class="panel-heading">--}}
            {{--TaskListName and AddTaskButton--}}
            {{--</div>--}}
            {{--<div class="panel-body">--}}
            {{--@if(count($tasklists) > 0)--}}
            {{--@foreach($tasklists as $tasklist)--}}
            {{--<div class="panel panel-default">--}}
            {{--<div class="panel-heading">--}}
            {{--{{$tasklist->name}}--}}
            {{--</div>--}}
            {{--<div class="panel-body">--}}
            {{--<div class="row">--}}
            {{--<div class="col-sm-12">--}}
            {{--<input type="text" form="editTask" name="desc" value="{{$task->desc}}">--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<form id="editTask" action="{{url('task/' . $task->id)}}" method="POST">--}}
            {{--{{csrf_field()}}--}}
            {{--</form>--}}
            {{--<form id="deleteTask" action="{{url('task/' . $task->id)}}" method="POST">--}}
            {{--{{csrf_field()}}--}}
            {{--{{method_field('DELETE')}}--}}
            {{--</form>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--@endforeach--}}
            {{--@else--}}
            {{--No task list yet.--}}
            {{--@endif--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
@endsection
