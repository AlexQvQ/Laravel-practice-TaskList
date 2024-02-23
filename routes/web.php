<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\TaskRequest;



Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')
    ->name('tasks.create');

Route::get('/tasks/{task}/edit', function (Task $task){
    return view('edit', ['task' => $task]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function (Task $task){
    return view('show', ['task' => $task]);
})->name('tasks.show');

Route::post('/tasks', function (TaskRequest $request){
    // $data = $request->validated();
    // $task = new Task;
    // $task-> title = $data['title'];
    // $task-> description = $data['description'];
    // $task-> long_description = $data['long_description'];
    $task = Task::create($request->validated());

    $task->save();
    return redirect()->route('tasks.show', ['task' => $task->id])
    ->with('success', 'Задание успешно создано!');

})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request){
    // $data = $request->validated();
    // $task-> title = $data['title'];
    // $task-> description = $data['description'];
    // $task-> long_description = $data['long_description'];
    // $task->save();
    $task -> update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
    ->with('success', 'Задание успешно обновлено(честно)!');

})->name('tasks.update');

Route::delete('/tasks/{task}', function(Task $task){
    $task->delete();
    return redirect()->route('tasks.index')->with('success', 'Все отлично удалилось');
})->name('tasks.destroy');

Route::put('tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task updated successfully!');
})->name('tasks.toggle-complete');
