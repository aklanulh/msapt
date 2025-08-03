@extends('layouts.app')

@section('title', 'Submission Saya - COMA')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 dark:bg-black/20 dark:border-gray-700/30 rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-500/20 mr-4">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-300 text-sm">Pending</p>
                            <p class="text-2xl font-bold text-white">{{ $pendingSubmissions->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-md border border-white/20 dark:bg-black/20 dark:border-gray-700/30 rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-500/20 mr-4">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-300 text-sm">Approved</p>
                            <p class="text-2xl font-bold text-white">{{ $completedSubmissions->where('status', 'approved')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-md border border-white/20 dark:bg-black/20 dark:border-gray-700/30 rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-500/20 mr-4">
                            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-300 text-sm">Rejected</p>
                            <p class="text-2xl font-bold text-white">{{ $completedSubmissions->where('status', 'rejected')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Submissions -->
            @if($pendingSubmissions->count() > 0)
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-white dark:text-gray-100 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Submission Pending
                    </h3>
                    
                    <div class="space-y-4">
                        @foreach($pendingSubmissions as $submission)
                            <div class="bg-white/10 backdrop-blur-md border border-white/20 dark:bg-black/20 dark:border-gray-700/30 rounded-lg p-6">
                                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between mb-4">
                                            <div>
                                                <h4 class="text-lg font-semibold text-white dark:text-gray-100 mb-2">
                                                    {{ $submission->task->title }}
                                                </h4>
                                                <div class="flex items-center space-x-4 text-sm text-gray-300">
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"></path>
                                                        </svg>
                                                        {{ $submission->task->category }}
                                                    </span>
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                                        </svg>
                                                        {{ $submission->task->points }} Poin
                                                    </span>
                                                </div>
                                            </div>
                                            <span class="px-3 py-1 bg-yellow-500/20 text-yellow-300 rounded-full text-sm font-medium">
                                                Pending
                                            </span>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <p class="text-gray-300 text-sm mb-2">Submission URL:</p>
                                            <a href="{{ $submission->submission_url }}" target="_blank" 
                                               class="text-blue-400 hover:text-blue-300 underline break-all">
                                                {{ $submission->submission_url }}
                                            </a>
                                        </div>
                                        
                                        <div class="flex justify-between items-center">
                                            <div class="text-gray-400 text-sm">
                                                Submitted: {{ $submission->submitted_at->format('d M Y, H:i') }}
                                            </div>
                                            <a href="{{ route('tasks.show', $submission->task->id) }}" 
                                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Completed Submissions -->
            @if($completedSubmissions->count() > 0)
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-white dark:text-gray-100 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Submission Selesai
                    </h3>
                    
                    <div class="space-y-4">
                        @foreach($completedSubmissions as $submission)
                            <div class="bg-white/10 backdrop-blur-md border border-white/20 dark:bg-black/20 dark:border-gray-700/30 rounded-lg p-6">
                                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between mb-4">
                                            <div>
                                                <h4 class="text-lg font-semibold text-white dark:text-gray-100 mb-2">
                                                    {{ $submission->task->title }}
                                                </h4>
                                                <div class="flex items-center space-x-4 text-sm text-gray-300">
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"></path>
                                                        </svg>
                                                        {{ $submission->task->category }}
                                                    </span>
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                                        </svg>
                                                        {{ $submission->task->points }} Poin
                                                    </span>
                                                </div>
                                            </div>
                                            <span class="px-3 py-1 rounded-full text-sm font-medium
                                                @if($submission->status === 'approved') bg-green-500/20 text-green-300
                                                @else bg-red-500/20 text-red-300
                                                @endif">
                                                {{ $submission->status === 'approved' ? 'Approved' : 'Rejected' }}
                                            </span>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <p class="text-gray-300 text-sm mb-2">Submission URL:</p>
                                            <a href="{{ $submission->submission_url }}" target="_blank" 
                                               class="text-blue-400 hover:text-blue-300 underline break-all">
                                                {{ $submission->submission_url }}
                                            </a>
                                        </div>
                                        
                                        @if($submission->notes)
                                            <div class="mb-4">
                                                <p class="text-gray-300 text-sm mb-2">Admin Notes:</p>
                                                <p class="text-gray-400 text-sm bg-gray-800/30 p-3 rounded">
                                                    {{ $submission->notes }}
                                                </p>
                                            </div>
                                        @endif
                                        
                                        <div class="flex justify-between items-center">
                                            <div class="flex flex-col text-gray-400 text-sm">
                                                <span>Submitted: {{ $submission->submitted_at->format('d M Y, H:i') }}</span>
                                                <span>Reviewed: {{ $submission->updated_at->format('d M Y, H:i') }}</span>
                                            </div>
                                            <a href="{{ route('tasks.show', $submission->task->id) }}" 
                                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Empty State -->
            @if($pendingSubmissions->count() === 0 && $completedSubmissions->count() === 0)
                <div class="bg-white/10 backdrop-blur-md border border-white/20 dark:bg-black/20 dark:border-gray-700/30 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-12 text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-white dark:text-gray-100 mb-2">
                            Belum Ada Submission
                        </h3>
                        <p class="text-gray-300 dark:text-gray-400 mb-6">
                            Anda belum mengirim submission untuk tugas apapun. Mulai kerjakan tugas dan kirim bukti pengerjaan Anda.
                        </p>
                        <a href="{{ route('tasks.index') }}" 
                           class="inline-flex items-center bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Lihat Tugas
                        </a>
                    </div>
                </div>
            @endif
    </div>
</div>
@endsection
