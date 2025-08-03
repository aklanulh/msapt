<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Submissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-center items-center bg-gradient-to-br from-purple-200 via-purple-300 to-purple-500 mb-8">
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <!-- Table for pending submissions -->
                    <h3 class="text-lg font-semibold mb-4 text-center text-gray-800 dark:text-gray-200">Pending Submissions</h3>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">Task ID</th>
                                <th scope="col" class="py-3 px-6">Submission URL</th>
                                <th scope="col" class="py-3 px-6">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendingSubmissions as $submission)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="py-4 px-6">
                                        <a href="{{ route('tasks.show', $submission->task_id) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                            {{ $submission->task_id }}
                                        </a>
                                    </td>
                                    <td class="py-4 px-6">
                                        <x-primary-link-button :href="$submission->submission_url" target="_blank">
                                            View Submission
                                        </x-primary-link-button>
                                    </td>
                                    <td class="py-4 px-6">{{ $submission->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($pendingSubmissions->isEmpty())
                        <p class="text-center text-gray-700 dark:text-gray-300">No submissions awaiting approval.</p>
                    @endif
                </div>
            </div>

            <div class="flex justify-center items-center bg-gradient-to-br from-purple-200 via-purple-300 to-purple-500">
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <!-- Table for approved or rejected submissions -->
                    <h3 class="text-lg font-semibold mb-4 text-center text-gray-800 dark:text-gray-200">Approved/Rejected Submissions</h3>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">Task ID</th>
                                <th scope="col" class="py-3 px-6">Submission URL</th>
                                <th scope="col" class="py-3 px-6">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($approvedRejectedSubmissions as $submission)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="py-4 px-6">
                                        <a href="{{ route('tasks.show', $submission->task_id) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                            {{ $submission->task_id }}
                                        </a>
                                    </td>
                                    <td class="py-4 px-6">
                                        <x-primary-link-button :href="$submission->submission_url" target="_blank">
                                            View Submission
                                        </x-primary-link-button>
                                    </td>
                                    <td class="py-4 px-6">{{ $submission->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($approvedRejectedSubmissions->isEmpty())
                        <p class="text-center text-gray-700 dark:text-gray-300">No submissions have been approved or rejected.</p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
