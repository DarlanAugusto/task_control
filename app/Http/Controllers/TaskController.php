<?php

namespace App\Http\Controllers;

use App\Exports\TasksExport;
use App\Mail\DestroyTaskMail;
use App\Mail\NewTaskMail;
use App\Mail\UpTaskMail;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks()->paginate(5);

        return view('app.task.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        return view('app.task.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'task' => ['required', 'min:3'],
            'deadline_date' => ['required', 'date']
        ];

        $feedbacks = [
            'task.required' => 'Informe a tarefa',
            'task.min' => 'A tarefa deve conter no mínimo 3 caracteres',
            'deadline_date.required' => 'Informe uma data limite',
            'deadline_date.date' => 'Data inválida'
        ];

        $request->validate($rules, $feedbacks);

        $task = new Task();
        $task->user_id = Auth::user()->id;
        $task->task = $request->get('task');
        $task->deadline_date = $request->get('deadline_date');
        $task->save();

        Mail::to(Auth::user()->email)->send(new NewTaskMail($task));
        return redirect()->route('task.show', $task->id);
    }

    public function show(Task $task)
    {
        return view('app.task.show', ['task' => $task]);
    }

    public function edit(Task $task)
    {
        if(Auth::user()->id != $task->user_id) {
            return redirect()->route('access.denied');
        }

        return view('app.task.edit', ['task' => $task]);
    }

    public function update(Request $request, Task $task)
    {
        if(Auth::user()->id != $task->user_id) {
            return redirect()->route('access.denied');
        }

        $previousTask = $task->getAttributes();
        $rules = [
            'task' => ['required', 'min:3'],
            'deadline_date' => ['required', 'date']
        ];

        $feedbacks = [
            'task.required' => 'Informe a tarefa',
            'task.min' => 'A tarefa deve conter no mínimo 3 caracteres',
            'deadline_date.required' => 'Informe uma data limite',
            'deadline_date.date' => 'Data inválida'
        ];

        $request->validate($rules, $feedbacks);

        $task->task = $request->get('task');
        $task->deadline_date = $request->get('deadline_date');

        $task->save();

        Mail::to(Auth::user()->email)->send(new UpTaskMail($previousTask, $task));
        return redirect()->route('task.show', $task->id);
    }

    public function destroy(Task $task)
    {
        if(Auth::user()->id != $task->user_id) {
            return redirect()->route('access.denied');
        }

        $task->delete();
        Mail::to(Auth::user()->email)->send(new DestroyTaskMail($task));

        return redirect()->route('task.index');
    }

    public function export($extension)
    {
        $suportedExtensions = ['xlsx', 'csv', 'pdf'];

        if(!in_array($extension, $suportedExtensions)) {
            return redirect()->route('task.index');
        }

        return Excel::download(new TasksExport, 'tasks_' . date('YmdHis') . '.' . $extension);
    }
}
