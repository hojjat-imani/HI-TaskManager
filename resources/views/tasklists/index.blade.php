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
                        <label for="task-name" class="col-sm-3 control-label">Task List</label>

                        <div class="col-sm-6">
                            <input type="text" name="name" id="task-name" class="form-control"
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
            @if(count($tasklists) > 0)
                @foreach($tasklists as $tasklist)
                    <div class="col col-lg-4 col-md-4 col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                {{$tasklist->name}}
                            </div>
                            <div class="panel-body">
                                @if(count($tasklists) > 0)
                                    @foreach($tasklists as $tasklist)
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                {{$tasklist->name}}
                                            </div>
                                            <div class="panel-body">
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
                                    @endforeach
                                @else
                                    No task list yet.
                                @endif
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
