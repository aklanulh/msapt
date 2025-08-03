<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Submissions -->
            <a href="{{ route('submissions.index') }}" class="block bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Submissions</h3>
                    <div class="flex justify-between">
                        <div class="w-1/2">
                            <p class="mb-1 text-gray-700 dark:text-gray-400">Total: {{ $totalSubmissions }}</p>
                            <p class="mb-1 text-gray-700 dark:text-gray-400">Pending: {{ $pendingSubmissions }}</p>
                            <p class="mb-1 text-gray-700 dark:text-gray-400">Approved: {{ $approvedSubmissions }}</p>
                            <p class="mb-1 text-gray-700 dark:text-gray-400">Rejected: {{ $rejectedSubmissions }}</p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Redeems -->
            <a href="{{ route('redeems.index') }}" class="block bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Redeems</h3>
                    <div class="flex justify-between">
                        <div class="w-1/2">
                            <p class="mb-1 text-gray-700 dark:text-gray-400">Total: {{ $totalRedeems }}</p>
                            <p class="mb-1 text-gray-700 dark:text-gray-400">Pending: {{ $pendingRedeems }}</p>
                            <p class="mb-1 text-gray-700 dark:text-gray-400">Approved: {{ $approvedRedeems }}</p>
                            <p class="mb-1 text-gray-700 dark:text-gray-400">Rejected: {{ $rejectedRedeems }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
