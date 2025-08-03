@extends('layouts.app')

@section('title', 'Tugas Kampanye - COMA')

@section('content')
<div class="container mx-auto px-4 py-8">


    <div class="max-w-7xl mx-auto">

            <!-- Header Section -->
            <div class="bg-white/10 backdrop-blur-md border border-white/20 dark:bg-black/20 dark:border-gray-700/30 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                        <div>
                            <h3 class="text-2xl font-bold text-white dark:text-gray-100 mb-2">
                                Tugas Tersedia 
                                <span class="text-lg font-normal text-gray-200 dark:text-gray-300">({{ $tasks->count() }} tugas)</span>
                            </h3>
                            <p class="text-gray-200 dark:text-gray-300">Pilih tugas kampanye yang ingin Anda kerjakan dan dapatkan poin</p>
                        </div>
                        
                        <!-- Sorting Controls -->
                        <div class="mt-4 sm:mt-0">
                            <form method="GET" action="{{ route('tasks.index') }}" class="flex items-center space-x-3">
                                <label for="sort" class="text-sm font-semibold text-white dark:text-gray-100 whitespace-nowrap">Urutkan:</label>
                                <select name="sort" id="sort" onchange="this.form.submit()" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-3 py-2 dark:bg-gray-900 dark:border-gray-500 dark:text-gray-100 shadow-lg font-medium">
                                    <option value="newest" {{ $sortBy == 'newest' ? 'selected' : '' }} class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-100 font-medium">Terbaru</option>
                                    <option value="oldest" {{ $sortBy == 'oldest' ? 'selected' : '' }} class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-100 font-medium">Terlama</option>
                                    <option value="deadline_asc" {{ $sortBy == 'deadline_asc' ? 'selected' : '' }} class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-100 font-medium">Deadline Terdekat</option>
                                    <option value="deadline_desc" {{ $sortBy == 'deadline_desc' ? 'selected' : '' }} class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-100 font-medium">Deadline Terjauh</option>
                                    <option value="points_high" {{ $sortBy == 'points_high' ? 'selected' : '' }} class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-100 font-medium">Poin Tertinggi</option>
                                    <option value="points_low" {{ $sortBy == 'points_low' ? 'selected' : '' }} class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-100 font-medium">Poin Terendah</option>
                                    <option value="title_asc" {{ $sortBy == 'title_asc' ? 'selected' : '' }} class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-100 font-medium">Judul A-Z</option>
                                    <option value="title_desc" {{ $sortBy == 'title_desc' ? 'selected' : '' }} class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-100 font-medium">Judul Z-A</option>
                                    <option value="category" {{ $sortBy == 'category' ? 'selected' : '' }} class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-100 font-medium">Kategori</option>
                                    <option value="status" {{ $sortBy == 'status' ? 'selected' : '' }} class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-100 font-medium">Status</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tasks Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($tasks as $task)
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 dark:bg-black/20 dark:border-gray-700/30 overflow-hidden shadow-sm sm:rounded-lg hover:bg-white/20 dark:hover:bg-black/30 transition-all duration-300 @if($task->deadline && $task->deadline < now()) border-red-500/50 @elseif($task->deadline && $task->deadline < now()->addHours(24)) border-yellow-500/50 @endif">
                        <div class="p-6">
                            <!-- Expired/Urgent Badge -->
                            @if($task->deadline && $task->deadline < now())
                                <div class="mb-3">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 animate-pulse">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                        </svg>
                                        EXPIRED
                                    </span>
                                </div>
                            @elseif($task->deadline && $task->deadline < now()->addHours(24))
                                <div class="mb-3">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        URGENT
                                    </span>
                                </div>
                            @endif
                            <!-- Category Badge -->
                            <div class="flex items-center justify-between mb-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    {{ $task->category }}
                                </span>
                                <span class="text-yellow-500 font-semibold">{{ $task->points }} poin</span>
                            </div>

                            <!-- Task Title -->
                            <h4 class="text-lg font-semibold text-white dark:text-gray-100 mb-2">{{ $task->title }}</h4>
                            <h4 class="text-lg font-semibold text-white dark:text-gray-100 mb-2">{{ $task->title }}</h4>
                            <p class="text-gray-200 dark:text-gray-300 text-sm mb-4 line-clamp-3">{{ Str::limit($task->description, 120) }}</p>
                            
                            <!-- Deadline with Status Indicator -->
                            <div class="flex items-center text-sm mb-4">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-gray-200 dark:text-gray-300 mr-2 font-medium">Deadline:</span>
                                @if($task->deadline)
                                    <span class="@if($task->deadline < now()) text-red-400 font-semibold @elseif($task->deadline < now()->addHours(24)) text-yellow-400 font-semibold @else text-gray-300 @endif">
                                        {{ $task->deadline->format('d M Y, H:i') }}
                                        @if($task->deadline < now())
                                            <span class="text-red-300 text-xs ml-1 font-semibold">(Expired)</span>
                                        @elseif($task->deadline < now()->addHours(24))
                                            <span class="text-yellow-300 text-xs ml-1 font-semibold">(Urgent)</span>
                                        @endif
                                    </span>
                                @else
                                    <span class="text-gray-200 dark:text-gray-300">Tidak ada deadline</span>
                                @endif
                            </div>

                            <!-- Action Button -->
                            <div class="flex justify-between items-center">
                                <a href="{{ route('tasks.show', $task->id) }}" class="@if($task->deadline && $task->deadline < now()) bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 @else bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 @endif text-white px-4 py-2 rounded-lg text-sm font-semibold transition transform hover:scale-105">
                                    @if($task->deadline && $task->deadline < now())
                                        Lihat Detail (Expired)
                                    @else
                                        Lihat Detail
                                    @endif
                                </a>
                                <span class="text-xs text-gray-200 dark:text-gray-300">
                                    @if($task->status === 'available' && (!$task->deadline || $task->deadline >= now()))
                                        <span class="text-green-300 font-semibold">● Tersedia</span>
                                    @elseif($task->deadline && $task->deadline < now())
                                        <span class="text-red-300 font-semibold">● Expired</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="bg-white/10 backdrop-blur-md border border-white/20 dark:bg-black/20 dark:border-gray-700/30 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-12 text-center">
                                <div class="text-gray-400 mb-4">
                                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-white dark:text-gray-100 mb-2">Belum Ada Tugas</h4>
                                <p class="text-gray-300 dark:text-gray-400">Tugas kampanye baru akan segera tersedia. Pantau terus halaman ini!</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
    </div>
</div>
@endsection
