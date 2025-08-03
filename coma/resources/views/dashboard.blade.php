@extends('layouts.app')

@section('title', 'Dashboard - COMA')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-800 dark:to-purple-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <h3 class="text-2xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="text-blue-100 dark:text-blue-200">Mulai mengerjakan kampanye dan kumpulkan poin untuk mendapatkan uang.</p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Total Points -->
                <div class="bg-white/10 backdrop-blur-md border border-white/20 dark:bg-black/20 dark:border-gray-700/30 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-white dark:text-gray-100">Total Poin</h4>
                                <p class="text-2xl font-bold text-white dark:text-gray-100">0</p>
                                <p class="text-sm text-gray-300 dark:text-gray-400">≈ Rp 0</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Completed Tasks -->
                <div class="bg-white/10 backdrop-blur-md border border-white/20 dark:bg-black/20 dark:border-gray-700/30 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-white dark:text-gray-100">Tugas Selesai</h4>
                                <p class="text-2xl font-bold text-white dark:text-gray-100">0</p>
                                <p class="text-sm text-gray-300 dark:text-gray-400">Kampanye</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Available Tasks -->
                <div class="bg-white/10 backdrop-blur-md border border-white/20 dark:bg-black/20 dark:border-gray-700/30 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-white dark:text-gray-100">Tugas Tersedia</h4>
                                <p class="text-2xl font-bold text-white dark:text-gray-100">0</p>
                                <p class="text-sm text-gray-300 dark:text-gray-400">Kampanye</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Available Campaigns -->
            <div class="bg-white/10 backdrop-blur-md border border-white/20 dark:bg-black/20 dark:border-gray-700/30 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white dark:text-gray-100 mb-4">Kampanye Tersedia</h3>
                    <div class="text-center py-8">
                        <div class="text-gray-400 mb-4">
                            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-white dark:text-gray-100 mb-2">Belum Ada Kampanye</h4>
                        <p class="text-gray-300 dark:text-gray-400">Kampanye baru akan segera tersedia. Pantau terus dashboard ini!</p>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white/10 backdrop-blur-md border border-white/20 dark:bg-black/20 dark:border-gray-700/30 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white dark:text-gray-100 mb-4">Aktivitas Terbaru</h3>
                    <div class="text-center py-8">
                        <div class="text-gray-400 mb-4">
                            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-white dark:text-gray-100 mb-2">Belum Ada Aktivitas</h4>
                        <p class="text-gray-300 dark:text-gray-400">Mulai mengerjakan kampanye untuk melihat aktivitas Anda di sini.</p>
                    </div>
                </div>
            </div>
</div>
@endsection
