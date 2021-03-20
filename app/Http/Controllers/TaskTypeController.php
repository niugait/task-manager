<?php

namespace App\Http\Controllers;

use App\Models\TaskType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TaskTypeController extends Controller
{
    public function index(): Collection|array
    {
        return TaskType::all();
    }

    public function show($id): Model|Builder
    {
        return TaskType::query()->where('id', $id)->firstOrFail();
    }

    public function store(Request $request)
    {
        $task_type = new TaskType();
        $task_type->fill($request->only('name'));
        $task_type->save();
    }

    public function update(Request $request, $id)
    {
        $task_type = TaskType::query()->where('id', $id)->firstOrFail();
        $task_type->update($request->only('name'));
        $task_type->save();
    }

    public function delete($id)
    {
        $task_type = TaskType::query()->where('id', $id)->firstOrFail();
        $task_type->delete();
    }
}
