<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Task Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold">{{ $task->title }}</h3>
                    <p class="mt-4">{{ $task->description }}</p>
                    <p class="mt-4">Points: {{ $task->points }}</p>
                    <p class="mt-4">Deadline: {{ $task->deadline }}</p>
                    
                    <form action="{{ route('submissions.store') }}" method="POST" class="mt-6">
                        @csrf
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <div class="mb-4">
                            <label for="submission_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Submission URL</label>
                            <input type="url" name="submission_url" id="submission_url" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                        </div>
                        <x-primary-button class="dark:bg-indigo-500 dark:hover:bg-indigo-600">
                            {{ __('Submit') }}
                        </x-primary-button>
                    </form>

                    <x-status-message :status="session('status')" class="mt-4" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
