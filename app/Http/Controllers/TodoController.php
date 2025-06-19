<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $todos = auth()->user()->todos()->orderBy('created_at', 'desc')->get();
        return view('todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date|after:now'
        ]);

        auth()->user()->todos()->create($validated);

        return redirect()->route('todos.index')->with('success', 'Todo créée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo): View
    {
        Gate::authorize('view', $todo);
        return view('todos.show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo): View
    {
        Gate::authorize('update', $todo);
        return view('todos.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo): RedirectResponse
    {
        Gate::authorize('update', $todo);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'completed' => 'boolean'
        ]);

        $todo->update($validated);

        return redirect()->route('todos.index')->with('success', 'Todo mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo): RedirectResponse
    {
        Gate::authorize('delete', $todo);
        
        $todo->delete();

        return redirect()->route('todos.index')->with('success', 'Todo supprimée avec succès !');
    }

    /**
     * Toggle the completed status of a todo.
     */
    public function toggle(Todo $todo): RedirectResponse
    {
        Gate::authorize('update', $todo);
        
        $todo->update(['completed' => !$todo->completed]);

        return redirect()->route('todos.index')->with('success', 'Statut de la todo mis à jour !');
    }
}
