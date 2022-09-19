@extends('layouts.master')

@section('content')
    <div class="container">
        <h2 class="my-3">Tasks List
            <a href="{{ route('tasks.create') }}" class="btn btn-primary ml-3"> + New Task </a>
        </h2>

        <div class="row">
            @include('partials.messages')
            @foreach ($tasks as $task)
                <div class="col-md-4">
                    <div class="p-3 my-2 border border-1 rounded shadow">
                        <h4 class="relative">
                            {{ $task->title }}
                            @include('partials.status')
                        </h4>
                        <p> {{ $task->description }} </p>
                        <p>
                            <img src="{{ Storage::url($task->image) }}" alt="" height="200px">
                        </p>
                        <div>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-success btn-sm ">Edit</a>
                            <a href="{{ route('tasks.destroy', $task->id) }}" class="btn btn-danger btn-sm ml-3">Delete</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
