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
                            <img src="{{ Storage::url($task->image) }}" alt="" height="200px" width="100%">
                        </p>
                        <div>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-success btn-sm ">Edit</a>
                            <a href="#deleteModal{{ $task->id }}" data-bs-toggle="modal" class="btn btn-danger btn-sm ml-3">Delete</a>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="deleteModal{{ $task->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModal{{ $task->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="deleteModal{{ $task->id }}">ARe you sure to delete ?</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p>Task - {{ $task->title }} Are you sure to delete? </p>
                        </div>
                        <div class="modal-footer">
                          <form action="{{ route('tasks.destroy', $task->id ) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  

            @endforeach
        </div>

        <div class="my-2">
            {{ $tasks->links() }}
        </div>

    </div>
@endsection
