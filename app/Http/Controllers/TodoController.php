<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('IndexTodo', [
            'todos' => Todo::with('user')->orderBy('id', 'desc')->get(),
            'users' => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('CreateTodo', [
            'users' => User::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'description' => 'required|string|max:255',
            'setor' => 'required|string|max:255',
            'priority' => 'required|string|in:Alta,Media,Baixa',
            'user_id' => 'required|exists:users,id',
        ]);

        $dados['priority'] = strtoupper($dados['priority']);

        Todo::create($dados);

        return redirect()->route('todos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        $users = User::all();
        return inertia('EditTodo', compact('todo', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $dados = $request->validate([
            'description' => 'required|string|max:255',
            'setor' => 'required|string|max:255',
            'priority' => 'required|string|in:ALTA,MEDIA,BAIXA',
            'user_id' => 'required|exists:users,id',
        ]);

        $todo->update($dados);

        return redirect()->route('todos.index');
    }

    public function changeStatus(Request $request, Todo $todo)
    {
        $todo->update([
            'status' => $request->input('status', $todo->status),
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return back();
    }
}
