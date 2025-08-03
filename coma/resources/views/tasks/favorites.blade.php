@extends('layouts.app')

@section('title', 'Tugas Favorit - COMA')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($favoriteTasks->count() > 0)
                <div class="mb-6">
                    <p class="text-gray-300 dark:text-gray-400 text-lg">
                        Anda memiliki {{ $favoriteTasks->count() }} tugas favorit
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($favoriteTasks as $task)
                        <div class="bg-white/10 backdrop-blur-md border border-white/20 dark:bg-black/20 dark:border-gray-700/30 overflow-hidden shadow-sm sm:rounded-lg hover:bg-white/20 dark:hover:bg-black/30 transition-all duration-300">
                            <div class="p-6">
                                <!-- Category Badge -->
                                <div class="flex justify-between items-start mb-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        {{ $task->category }}
                                    </span>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-yellow-400 font-bold text-lg">{{ $task->points }} Poin</span>
                                        <!-- Favorite indicator -->
                                        <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                    </div>
                                </div>

                                <!-- Task Title -->
                                <h3 class="text-xl font-semibold text-white dark:text-gray-100 mb-3">
                                    {{ $task->title }}
                                </h3>

                                <!-- Task Description -->
                                <p class="text-gray-300 dark:text-gray-400 text-sm mb-4 line-clamp-3">
                                    {{ Str::limit($task->description, 120) }}
                                </p>

                                <!-- Task Info -->
                                <div class="space-y-2 mb-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-400 text-sm">Deadline:</span>
                                        <span class="text-gray-300 text-sm font-medium">{{ $task->deadline->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-400 text-sm">Status:</span>
                                        <span class="px-2 py-1 rounded text-xs font-medium
                                            @if($task->status === 'available') bg-green-500/20 text-green-300
                                            @elseif($task->status === 'completed') bg-blue-500/20 text-blue-300
                                            @else bg-gray-500/20 text-gray-300
                                            @endif">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex space-x-2">
                                    <a href="{{ route('tasks.show', $task->id) }}" 
                                       class="flex-1 bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white text-center py-2 px-4 rounded-lg font-semibold transition transform hover:scale-105">
                                        Lihat Detail
                                    </a>
                                    
                                    <!-- Remove from favorites -->
                                    <form action="{{ route('tasks.favorite', $task->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="bg-red-500/20 border border-red-500/30 text-red-300 hover:bg-red-500/30 px-3 py-2 rounded-lg transition"
                                                title="Hapus dari favorit">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white/10 backdrop-blur-md border border-white/20 dark:bg-black/20 dark:border-gray-700/30 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-12 text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-white dark:text-gray-100 mb-2">
                            Belum Ada Tugas Favorit
                        </h3>
                        <p class="text-gray-300 dark:text-gray-400 mb-6">
                            Anda belum menambahkan tugas apapun ke favorit. Mulai jelajahi tugas yang tersedia dan tambahkan yang menarik ke favorit Anda.
                        </p>
                        <a href="{{ route('tasks.index') }}" 
                           class="inline-flex items-center bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Jelajahi Tugas
                        </a>
                    </div>
                </div>
            @endif
    </div>
</div>
@endsection
