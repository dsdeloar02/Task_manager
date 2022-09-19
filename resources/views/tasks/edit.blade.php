@extends('layouts.master')

@section('content')
    <div class="container">
        <h2 class="my-3">Edit Tasks</h2>

        <div class="shadow border border-1 p-4 rounded ">
            <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('partials.messages')
                <div class="mb-3">
                    <label for="title" class="form-label">Task title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Write task title" value="{{ $task->title }}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Task Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">
                        {{ $task->description }}
                    </textarea>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Task Description</label>
                    <select name="status" id="status" class="form-control">
                        <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }} >Active</option>
                        <option value="active" {{ $task->status === 'active' ? 'selected' : '' }} >Pending</option>
                        <option value="done" {{ $task->status === 'done' ? 'selected' : '' }} >Done</option>
                    </select>
                </div>
                <div class="md-3">
                    <label for="image" class="form-label">Task Image</label>
                    @if ($task->image)
                        <p>Old Image</p>
                        <img src="{{ Storage::url($task->image) }}" alt="" height="100px">
                    @endif
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        Add..
                    </button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
