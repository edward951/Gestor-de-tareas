<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Mail\TaskCreated;
use App\Mail\TaskCompleted;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = auth()->user()->tasks()->where('filled', false)->orderBy('expiration_date', 'asc')->paginate(10);
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
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'expiration_date' => 'required|date',
        ]);

        $task = auth()->user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'expiration_date' => $request->expiration_date,
            'filled' => false,
        ]);

        Mail::to(auth()->user()->email)->send(new TaskCreated($task));


        return redirect()->route('tasks.index')->with('success', 'Tarea creada exitosamente.');
        exit();
    }

    public function completedTasks()
    {
        $tasks = auth()->user()->tasks()->where('filled', true)->orderBy('expiration_date')->paginate(10);
        return view('tasks.completed', compact('tasks'));
    }

    public function updateStatus(Request $request, $id)
    {
        $task = Task::find($id);

        if ($task) {
            $task->filled = $request->input('completed') ? 1 : 0;
            $task->save();

            if ($task->filled) {
                Mail::to($task->user->email)->send(new TaskCompleted($task));
            }

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'title' => 'required|string|max:255',
            'expiration_date' => 'required|date',
        ]);

        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {

        $this->authorize('delete', $task);

        $task->delete();

        return response()->json(['success' => true]);
    }
}
