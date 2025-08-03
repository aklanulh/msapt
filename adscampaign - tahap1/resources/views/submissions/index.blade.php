<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Submissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($submissions->count() > 0)
                        <ul>
                            @foreach ($submissions as $submission)
                                <li>
                                    <strong>Submission ID: {{ $submission->id }}</strong>
                                    <p>User ID: {{ $submission->user_id }}</p>
                                    <p>Task ID: {{ $submission->task_id }}</p>
                                    <p>Submission URL: {{ $submission->submission_url }}</p>
                                    <p>Status: {{ $submission->status }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No submissions found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
