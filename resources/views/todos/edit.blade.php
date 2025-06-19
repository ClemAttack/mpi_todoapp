@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-4">
                <a href="{{ route('todos.index') }}" class="text-blue-600 hover:text-blue-800 transition duration-200">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Modifier la Todo</h1>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('todos.update', $todo) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Titre <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               value="{{ old('title', $todo->title) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                               placeholder="Entrez le titre de votre todo"
                               required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                                  placeholder="Ajoutez une description (optionnel)">{{ old('description', $todo->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Due Date -->
                    <div>
                        <label for="due_date" class="block text-sm font-medium text-gray-700 mb-2">
                            Date d'échéance
                        </label>
                        <input type="datetime-local" 
                               name="due_date" 
                               id="due_date" 
                               value="{{ old('due_date', $todo->due_date ? $todo->due_date->format('Y-m-d\TH:i') : '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('due_date') border-red-500 @enderror">
                        @error('due_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Laissez vide si pas d'échéance</p>
                    </div>

                    <!-- Completed Status -->
                    <div>
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   name="completed" 
                                   id="completed" 
                                   value="1"
                                   {{ old('completed', $todo->completed) ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="completed" class="ml-2 block text-sm text-gray-900">
                                Marquer comme terminée
                            </label>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('todos.index') }}" 
                           class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                            Annuler
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                            <i class="fas fa-save mr-2"></i>Mettre à jour
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 