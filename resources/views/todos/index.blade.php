@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Mes Todos</h1>
            <a href="{{ route('todos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                <i class="fas fa-plus mr-2"></i>Nouvelle Todo
            </a>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-list text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $todos->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-check text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Terminées</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $todos->where('completed', true)->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100 text-red-600">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">En retard</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $todos->where('is_overdue', true)->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Todos List -->
        @if($todos->count() > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="divide-y divide-gray-200">
                    @foreach($todos as $todo)
                        <div class="p-6 hover:bg-gray-50 transition duration-200 {{ $todo->completed ? 'opacity-75' : '' }}">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start space-x-3 flex-1">
                                    <form action="{{ route('todos.toggle', $todo) }}" method="POST" class="mt-1">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="w-5 h-5 rounded border-2 {{ $todo->completed ? 'bg-green-500 border-green-500' : 'border-gray-300' }} flex items-center justify-center transition duration-200">
                                            @if($todo->completed)
                                                <i class="fas fa-check text-white text-xs"></i>
                                            @endif
                                        </button>
                                    </form>
                                    
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center space-x-2">
                                            <h3 class="text-lg font-medium text-gray-900 {{ $todo->completed ? 'line-through' : '' }}">
                                                {{ $todo->title }}
                                            </h3>
                                            @if($todo->is_overdue)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    En retard
                                                </span>
                                            @endif
                                        </div>
                                        
                                        @if($todo->description)
                                            <p class="mt-1 text-sm text-gray-600 {{ $todo->completed ? 'line-through' : '' }}">
                                                {{ $todo->description }}
                                            </p>
                                        @endif
                                        
                                        <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                                            <span class="flex items-center">
                                                <i class="fas fa-calendar mr-1"></i>
                                                Créée le {{ $todo->created_at->format('d/m/Y') }}
                                            </span>
                                            @if($todo->due_date)
                                                <span class="flex items-center {{ $todo->is_overdue ? 'text-red-600' : '' }}">
                                                    <i class="fas fa-clock mr-1"></i>
                                                    Échéance : {{ $todo->due_date->format('d/m/Y') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-2 ml-4">
                                    <a href="{{ route('todos.show', $todo) }}" class="text-blue-600 hover:text-blue-800 transition duration-200">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('todos.edit', $todo) }}" class="text-green-600 hover:text-green-800 transition duration-200">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette todo ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition duration-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <div class="mx-auto h-12 w-12 text-gray-400">
                    <i class="fas fa-clipboard-list text-4xl"></i>
                </div>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune todo</h3>
                <p class="mt-1 text-sm text-gray-500">Commencez par créer votre première todo.</p>
                <div class="mt-6">
                    <a href="{{ route('todos.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i>Nouvelle Todo
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection 