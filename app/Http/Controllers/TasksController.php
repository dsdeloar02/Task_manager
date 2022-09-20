<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Str;
use App\Http\Requests\TaskCreateRequest;
use Illuminate\Support\Facades\Storage;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('id', 'desc')->paginate(9);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskCreateRequest $request)
    {
        // dd($request);

        $task = new task();
        $task->title = $request->title;
        $task->slug = Str::of($request->title)->slug;
        $task->description = $request->description;
        $task->status = $request->status;
        $file = $request->file('image');
        $image_name = Str::of($request->tile)->slug().'-'.time().$file->extension();
        // dd($image_name);
        $task->image = $file->storePubliclyAs('public/tasks', $image_name);
        $task->save();


        // process of slug uniqe

        $task->slug = $task->slug.'-'. $task->id;
        $task->save();

        session()->flash('success', 'Task Created successful!');

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }


    // 01 Way edit one

    // public function edit(string $slug){
    //     $task = Task::where('slug', $slug)->first();
    //     if(!$task){
    //         abort(404);
    //     }
    //     return view('tasks.edit', compact('task'));
    // }


    // 02 Way edit one
    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Task  $task
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Task $task)
    // {
    //     return view('tasks.edit', compact('task'));
    // }

    // 03 Way edit one

    public function edit($id_or_slug)
    {
        $task =  $this->getTaskyIdOrSlug($id_or_slug);

        if (!$task) {
            session()->flash('error', 'Sorry,Task is not found ! ');
            return redirect()->route('tasks.index');
        }

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskCreateRequest $request, $id_or_slug)
    {
        $task =  $this->getTaskyIdOrSlug($id_or_slug);
        if (!$task) {
            session()->flash('error', 'Sorry,Task is not found ! ');
            return redirect()->route('tasks.index');
        }
        $task->title = $request->title;
        $task->slug = Str::of($request->title)->slug.'-'. $task->id;
        $task->description = $request->description;
        $task->status = $request->status;

        if($request->image){
            if($task->image){
                Storage::delete($task->image);
            }
            $file = $request->file('image');
            // dd($file);
            $image_name = Str::of($request->tile)->slug().'-'.time().$file->extension();
            $task->image = $file->storePubliclyAs('public/tasks', $image_name);
        }
        $task->save();

        session()->flash('success', 'Task Updated successful!');

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_or_slug)
    {

        // Find First

        $task =  $this->getTaskyIdOrSlug($id_or_slug);
        if (!$task) {
            session()->flash('error', 'Sorry,Task is not found ! ');
            return redirect()->route('tasks.index');
        }

        // Check if any image
        if($task->image){
            Storage::delete($task->image);
        }
        // Delete
        $task->delete();

        // Success messegae

        
        session()->flash('success', 'Task Deleted successful!');

        return redirect()->route('tasks.index');
    }



    public function getTaskyIdOrSlug($id_or_slug)
    {
        if (is_numeric($id_or_slug)) {
            return Task::find($id_or_slug);
        } else {
            return Task::where('slug', $id_or_slug)->first();
        }
    }
}
