<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(): Collection|array
    {
        return Task::all();
    }

    public function finish($id) {
        $task = Task::query()->where('id', $id)->firstOrFail();
        $task->finished_at = Carbon::now();
        $task->save();
    }

    public function show($id): Model|Builder|Task
    {
        return Task::query()->where('id', $id)->firstOrFail();
    }

    public function store(Request $request)
    {
        $task = new Task();
        $task->fill($request->only(['description', 'due', 'task_types_id']));
        $task->save();
    }

    public function update(Request $request, $id)
    {
        $task = Task::query()->where('id', $id)->firstOrFail();
        $task->update($request->only(['description', 'due', 'task_types_id']));
        $task->save();
    }

    /**
     * @param $id
     * @throws \Exception
     */
    public function delete($id)
    {
        $task = Task::query()->where('id', $id)->firstOrFail();
        $task->delete();
    }
}
