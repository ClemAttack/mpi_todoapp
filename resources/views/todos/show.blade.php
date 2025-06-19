@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('todos.index') }}" class="text-blue-600 hover:text-blue-800 transition duration-200">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">Détails de la Todo</h1>
                </div>
                <div class="flex items-center space-x-2">
                    <a href="{{ route('todos.edit', $todo) }}" class="text-green-600 hover:text-green-800 transition duration-200">
                        <i class="fas fa-edit text-xl"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Todo Details -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <!-- Status Header -->
            <div class="px-6 py-4 border-b border-gray-200 {{ $todo->completed ? 'bg-green-50' : 'bg-gray-50' }}">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-6 h-6 rounded-full border-2 {{ $todo->completed ? 'bg-green-500 border-green-500' : 'border-gray-300' }} flex items-center justify-center">
                            @if($todo->completed)
                                <i class="fas fa-check text-white text-xs"></i>
                            @endif
                        </div>
                        <span class="text-sm font-medium {{ $todo->completed ? 'text-green-800' : 'text-gray-600' }}">
                            {{ $todo->completed ? 'Terminée' : 'En cours' }}
                        </span>
                    </div>
                    @if($todo->is_overdue)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            En retard
                        </span>
                    @endif
                </div>
            </div>

            <!-- Content -->
            <div class="px-6 py-6">
                <div class="space-y-6">
                    <!-- Title -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 {{ $todo->completed ? 'line-through' : '' }}">
                            {{ $todo->title }}
                        </h2>
                    </div>

                    <!-- Description -->
                    @if($todo->description)
                        <div>
                            <h3 class="text-sm font-medium text-gray-700 mb-2">Description</h3>
                            <p class="text-gray-600 {{ $todo->completed ? 'line-through' : '' }}">
                                {{ $todo->description }}
                            </p>
                        </div>
                    @endif

                    <!-- Metadata -->
                    <div class="border-t border-gray-200 pt-6">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Créée le</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $todo->created_at->format('d/m/Y à H:i') }}</dd>
                            </div>
                            
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Dernière modification</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $todo->updated_at->format('d/m/Y à H:i') }}</dd>
                            </div>
                            
                            @if($todo->due_date)
                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Date d'échéance</dt>
                                    <dd class="mt-1 text-sm {{ $todo->is_overdue ? 'text-red-600 font-medium' : 'text-gray-900' }}">
                                        {{ $todo->due_date->format('d/m/Y à H:i') }}
                                        @if($todo->is_overdue)
                                            <span class="ml-2 text-xs bg-red-100 text-red-800 px-2 py-1 rounded">
                                                En retard de {{ $todo->due_date->diffForHumans() }}
                                            </span>
                                        @endif
                                    </dd>
                                </div>
                            @endif
                        </dl>
                    </div>

                    <!-- Actions -->
                    <div class="border-t border-gray-200 pt-6">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-4">
                                <form action="{{ route('todos.toggle', $todo) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md {{ $todo->completed ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                                        <i class="fas {{ $todo->completed ? 'fa-undo' : 'fa-check' }} mr-2"></i>
                                        {{ $todo->completed ? 'Marquer comme non terminée' : 'Marquer comme terminée' }}
                                    </button>
                                </form>
                            </div>
                            
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('todos.edit', $todo) }}" 
                                   class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                                    <i class="fas fa-edit mr-2"></i>Modifier
                                </a>
                                <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette todo ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200">
                                        <i class="fas fa-trash mr-2"></i>Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 