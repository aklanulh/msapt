<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($tasks->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($tasks as $task)
                        <a href="{{ route('tasks.show', $task->id) }}" class="block bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $task->title }}</h3>
                            <p class="text-gray-700 dark:text-gray-400">{{ $task->description }}</p>
                            <p class="text-gray-600 dark:text-gray-300">Points: {{ $task->points }}</p>
                            <p class="text-gray-600 dark:text-gray-300">Deadline: {{ $task->deadline }}</p>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-gray-900 dark:text-gray-100">No tasks found.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
