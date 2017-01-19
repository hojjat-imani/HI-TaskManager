@extends('layouts.app')

@section('content')
    <div class="container-fluid container-scroll">
        <div class="row">
            <div class="col-sm-12">
                <!-- Display Validation Errors -->
            @include('common.errors')

            <!-- New Task Form -->
                <form action="{{ url('tasklist') }}" method="POST" class="form-horizontal">
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
                @for ($i = 0; $i < count($tasklists); $i++)
                    <?php $tasklist = $tasklists[$i]; ?>
                    <div class="col col-sm-4" style="margin: 1rem">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <form id="deleteTaskList" action="{{url('tasklist/' . $tasklist->id)}}"
                                      method="POST">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="close"
                                    >&times;</button>
                                </form>
                                {{$tasklist->name}}
                            </div>
                            <div class="panel-body">
                                @if(count($tasks) > 0)
                                    @for ($j = 0; $j < count($tasks); $j++)
                                        <?php $task = $tasks[$j]; ?>
                                        @if($tasklist->id == $task->tasklist_id)
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div style="position: relative">
                                                        <form id="deleteTask" action="{{url('task/' . $task->id)}}"
                                                              method="POST">
                                                            {{csrf_field()}}
                                                            {{method_field('DELETE')}}
                                                            <button type="submit" class="close"
                                                            >&times;</button>
                                                        </form>
                                                        <button type="button" class="btn btn-link " style="position: absolute; right: 0; bottom:0"
                                                        data-toggle="modal"
                                                        data-target="#editTaskModal{{$task->id}}">
                                                        edit</span>
                                                        </button>
                                                        <p><strong>{{$task->name}}</strong></p>
                                                        <p style="padding: 1rem">{{$task->desc}}</p>
                                                        <!-- Modal -->
                                                        <div id="editTaskModal{{$task->id}}" class="modal fade" role="dialog">
                                                            <div class="modal-dialog">

                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal">&times;</button>
                                                                        <h4 class="modal-title">Edit Task</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- New Task Form -->
                                                                        <form action="{{url('edit/' . $task->id)}}" method="POST"
                                                                              class="form-horizontal">
                                                                            {{ csrf_field() }}

                                                                            <div class="form-group">
                                                                                <label for="task-name"
                                                                                       class="col-sm-2 control-label text-center">Task
                                                                                    Name</label>

                                                                                <div class="col-sm-10">
                                                                                    <input type="text" name="name" id="task-name"
                                                                                           class="form-control"
                                                                                           value="{{$task->name}}">
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="task-desc"
                                                                                       class="col-sm-2 control-label text-center">Description</label>

                                                                                <div class="col-sm-10">
                                                                                    <input type="text" name="desc" id="task-desc"
                                                                                           class="form-control"
                                                                                           value="{{$task->desc}}">
                                                                                </div>
                                                                            </div>

                                                                            <!-- Add Task Button -->
                                                                            <div class="form-group">
                                                                                <div class="col-sm-offset-3 col-sm-6">
                                                                                    <button type="submit" class="btn btn-default">
                                                                                        Done
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </form>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        @if ($i < count($tasklists) - 1)
                                                            <form id="moveTaskRight{{$task->id}}"
                                                                  action="{{url('moveTaskToAnotherList/' . $task->id)}}"
                                                                  method="POST">
                                                                {{csrf_field()}}
                                                                <input type="hidden" name="tasklist_id"
                                                                       value="{{$tasklists[$i+1]->id}}">
                                                                <button type="submit" class="close"
                                                                        style="margin-right: 1rem; margin-left: 1rem"
                                                                ><span class="glyphicon glyphicon-arrow-right"></span>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        @if ($i > 0)
                                                            <form id="moveTaskLeft"
                                                                  action="{{url('moveTaskToAnotherList/' . $task->id)}}"
                                                                  method="POST">
                                                                {{csrf_field()}}
                                                                <input type="hidden" name="tasklist_id"
                                                                       value="{{$tasklists[$i-1]->id}}">
                                                                <button type="submit" class="close"
                                                                        style="margin-right: 1rem; margin-left: 1rem"
                                                                ><span class="glyphicon glyphicon-arrow-left"></span>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endfor
                                @endif
                                <div class="text-center">
                                    <!-- Trigger the modal with a button -->
                                    <button type="button" class="btn btn-default" data-toggle="modal"
                                            data-target="#addTaskModal{{$tasklist->id}}"><i
                                                class="fa fa-btn fa-plus"></i>New Task
                                    </button>

                                    <!-- Modal -->
                                    <div id="addTaskModal{{$tasklist->id}}" class="modal fade" role="dialog">
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
                    {{--@endforeach--}}
                @endfor
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
