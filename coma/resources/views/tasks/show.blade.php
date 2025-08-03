@extends('layouts.app')

@section('title', 'Detail Tugas - COMA')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('tasks.index') }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 text-sm font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar Tugas
            </a>
        </div>
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="bg-green-500/20 border border-green-500/30 text-green-100 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-500/20 border border-red-500/30 text-red-100 px-4 py-3 rounded-lg mb-6">
                    {{ session('error') }}
                </div>
            @endif
            <!-- Task Detail Card -->
            <div class="bg-white/10 backdrop-blur-md border border-white/20 dark:bg-black/20 dark:border-gray-700/30 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                {{ $task->category }}
                            </span>
                            @if($task->deadline && $task->deadline < now())
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 animate-pulse">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                    EXPIRED
                                </span>
                            @elseif($task->deadline && $task->deadline < now()->addHours(24))
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    DEADLINE DEKAT
                                </span>
                            @endif
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-yellow-400">{{ $task->points }} Poin</div>
                            <div class="text-sm text-gray-400">≈ Rp {{ number_format($task->points * 1000, 0, ',', '.') }}</div>
                        </div>
                    </div>

                    <!-- Title -->
                    <div class="mb-4">
                        <h1 class="text-3xl font-bold text-white dark:text-gray-100 mb-2">{{ $task->title }}</h1>
                        @if($task->deadline)
                            <div class="flex items-center space-x-2 text-sm">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-gray-400">Deadline:</span>
                                <span class="@if($task->deadline < now()) text-red-400 font-semibold @elseif($task->deadline < now()->addHours(24)) text-yellow-400 font-semibold @else text-gray-300 @endif">
                                    {{ $task->deadline->format('d M Y, H:i') }} WIB
                                    @if($task->deadline < now())
                                        <span class="text-red-400 ml-1">(Sudah Berakhir)</span>
                                    @elseif($task->deadline < now()->addHours(24))
                                        <span class="text-yellow-400 ml-1">({{ $task->deadline->diffForHumans() }})</span>
                                    @else
                                        <span class="text-gray-400 ml-1">({{ $task->deadline->diffForHumans() }})</span>
                                    @endif
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-white dark:text-gray-100 mb-3">Deskripsi Tugas</h3>
                        <p class="text-gray-300 dark:text-gray-400 leading-relaxed">{{ $task->description }}</p>
                    </div>

                    <!-- Requirements -->
                    @if($task->requirements && is_array($task->requirements) && count($task->requirements) > 0)
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-white dark:text-gray-100 mb-3">Persyaratan</h3>
                            <ul class="space-y-2">
                                @foreach($task->requirements as $requirement)
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 text-green-400 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-300 dark:text-gray-400">{{ $requirement }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Task Info -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-white/5 rounded-lg p-4">
                            <div class="text-gray-400 text-sm mb-1">Deadline</div>
                            <div class="text-white font-semibold">{{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}</div>
                        </div>
                        <div class="bg-white/5 rounded-lg p-4">
                            <div class="text-gray-400 text-sm mb-1">Status</div>
                            <div class="text-green-400 font-semibold">
                                @if($task->status === 'available')
                                    Tersedia
                                @elseif($task->status === 'in_progress')
                                    Sedang Dikerjakan
                                @elseif($task->status === 'completed')
                                    Selesai
                                @else
                                    Kadaluarsa
                                @endif
                            </div>
                        </div>
                        <div class="bg-white/5 rounded-lg p-4">
                            <div class="text-gray-400 text-sm mb-1">Kategori</div>
                            <div class="text-white font-semibold">{{ $task->category }}</div>
                        </div>
                    </div>

                    <!-- Submission Form -->
                    @if(!$userSubmission && $task->status === 'available')
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-white dark:text-gray-100 mb-4">Submit Bukti Pengerjaan</h3>
                            <form action="{{ route('tasks.submit', $task->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                
                                <!-- General validation error -->
                                @error('submission')
                                    <div class="bg-red-500/20 border border-red-500/30 text-red-100 px-4 py-3 rounded-lg mb-4">
                                        {{ $message }}
                                    </div>
                                @enderror
                                
                                <div class="bg-blue-500/10 border border-blue-500/30 text-blue-100 px-4 py-3 rounded-lg mb-4">
                                    <p class="text-sm">💡 <strong>Petunjuk:</strong> Isi salah satu atau kedua field di bawah ini sebagai bukti pengerjaan tugas.</p>
                                </div>
                                
                                <div>
                                    <label for="submission_url" class="block text-sm font-medium text-gray-300 mb-2">URL Submission (Opsional):</label>
                                    <input type="url" id="submission_url" name="submission_url" value="{{ old('submission_url') }}"
                                           class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           placeholder="https://example.com/your-work">
                                    <p class="text-gray-400 text-xs mt-1">Link ke hasil pekerjaan Anda (website, social media post, dll.)</p>
                                    @error('submission_url')
                                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="screenshot" class="block text-sm font-medium text-gray-300 mb-2">Screenshot Bukti (Opsional):</label>
                                    <input type="file" id="screenshot" name="screenshot" accept="image/*"
                                           class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <p class="text-gray-400 text-xs mt-1">Upload gambar sebagai bukti pengerjaan. Format: JPG, PNG, GIF. Maksimal 2MB.</p>
                                    @error('screenshot')
                                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-6 py-3 rounded-lg font-semibold transition transform hover:scale-105 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Submit Tugas
                                </button>
                            </form>
                        </div>
                    @elseif($userSubmission)
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-white dark:text-gray-100 mb-4">Status Submission Anda</h3>
                            <div class="bg-white/5 rounded-lg p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-gray-300">Status:</span>
                                    <span class="px-3 py-1 rounded-full text-sm font-medium
                                        @if($userSubmission->status === 'pending') bg-yellow-500/20 text-yellow-300
                                        @elseif($userSubmission->status === 'approved') bg-green-500/20 text-green-300
                                        @else bg-red-500/20 text-red-300 @endif">
                                        @if($userSubmission->status === 'pending') Menunggu Review
                                        @elseif($userSubmission->status === 'approved') Disetujui
                                        @else Ditolak @endif
                                    </span>
                                </div>
                                
                                @if($userSubmission->status === 'pending')
                                    <!-- Edit Form for Pending Submissions -->
                                    <div class="mb-4">
                                        <form action="{{ route('tasks.update-submission', $task->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                            @csrf
                                            @method('PUT')
                                            
                                            <!-- General validation error -->
                                            @error('submission')
                                                <div class="bg-red-500/20 border border-red-500/30 text-red-100 px-4 py-3 rounded-lg mb-4">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            
                                            <div class="bg-blue-500/10 border border-blue-500/30 text-blue-100 px-4 py-3 rounded-lg mb-4">
                                                <p class="text-sm">💡 <strong>Petunjuk:</strong> Isi salah satu atau kedua field di bawah ini sebagai bukti pengerjaan tugas.</p>
                                            </div>
                                            
                                            <div>
                                                <label for="edit_submission_url" class="block text-sm font-medium text-gray-300 mb-2">URL Submission (Opsional):</label>
                                                <input type="url" id="edit_submission_url" name="submission_url" 
                                                       value="{{ old('submission_url', $userSubmission->submission_url) }}"
                                                       class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                       placeholder="https://example.com/your-work">
                                                <p class="text-gray-400 text-xs mt-1">Link ke hasil pekerjaan Anda (website, social media post, dll.)</p>
                                                @error('submission_url')
                                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            
                                            <div>
                                                <label for="edit_screenshot" class="block text-sm font-medium text-gray-300 mb-2">Screenshot Bukti (Opsional):</label>
                                                @if($userSubmission->screenshot_path)
                                                    <div class="mb-3">
                                                        <img src="{{ asset('storage/' . $userSubmission->screenshot_path) }}" alt="Screenshot" class="max-w-xs rounded-lg border border-white/20">
                                                        <p class="text-gray-400 text-xs mt-1">Screenshot saat ini</p>
                                                    </div>
                                                @endif
                                                <input type="file" id="edit_screenshot" name="screenshot" accept="image/*"
                                                       class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                <p class="text-gray-400 text-xs mt-1">Upload gambar sebagai bukti pengerjaan. Format: JPG, PNG, GIF. Maksimal 2MB. {{ $userSubmission->screenshot_path ? 'Upload file baru untuk mengganti screenshot.' : '' }}</p>
                                                @error('screenshot')
                                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            
                                            <button type="submit" class="bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 text-white px-6 py-2 rounded-lg font-semibold transition transform hover:scale-105 flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Update Submission
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <!-- Read-only view for reviewed submissions -->
                                    <div class="mb-3">
                                        <span class="text-gray-300">URL Submission:</span>
                                        <a href="{{ $userSubmission->submission_url }}" target="_blank" class="text-blue-400 hover:text-blue-300 ml-2 break-all">{{ $userSubmission->submission_url }}</a>
                                    </div>
                                    
                                    @if($userSubmission->screenshot_path)
                                        <div class="mb-3">
                                            <span class="text-gray-300">Screenshot Bukti:</span>
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $userSubmission->screenshot_path) }}" alt="Screenshot Bukti" class="max-w-md rounded-lg border border-white/20 cursor-pointer" onclick="openImageModal(this.src)">
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if($userSubmission->notes)
                                        <div class="mb-3">
                                            <span class="text-gray-300">Catatan Admin:</span>
                                            <p class="text-gray-400 mt-1 bg-gray-800/30 p-3 rounded">{{ $userSubmission->notes }}</p>
                                        </div>
                                    @endif
                                @endif

                                <div class="text-sm text-gray-400">
                                    <span class="text-gray-300">Dikirim:</span>
                                    <span class="ml-2">{{ $userSubmission->submitted_at->format('d M Y H:i') }}</span>
                                    @if($userSubmission->status !== 'pending')
                                        <span class="mx-2">•</span>
                                        <span class="text-gray-300">Direview:</span>
                                        <span class="ml-2">{{ $userSubmission->updated_at->format('d M Y H:i') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <form action="{{ route('tasks.favorite', $task->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="border border-white/30 text-white px-8 py-3 rounded-lg font-semibold hover:bg-white/10 transition flex items-center justify-center w-full sm:w-auto
                                {{ $isFavorited ? 'bg-red-500/20 border-red-500/30' : '' }}">
                                <svg class="w-5 h-5 mr-2" fill="{{ $isFavorited ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                {{ $isFavorited ? 'Hapus dari Favorit' : 'Simpan ke Favorit' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Related Tasks -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold text-white dark:text-gray-100 mb-4">Tugas Serupa</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Placeholder for related tasks -->
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 dark:bg-black/20 dark:border-gray-700/30 rounded-lg p-4">
                        <div class="text-center py-8 text-gray-400">
                            Tugas serupa akan ditampilkan di sini
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden flex items-center justify-center p-4" onclick="closeImageModal()">
    <div class="relative max-w-4xl max-h-full">
        <img id="modalImage" src="" alt="Screenshot" class="max-w-full max-h-full rounded-lg">
        <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white bg-black bg-opacity-50 rounded-full p-2 hover:bg-opacity-75">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openImageModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }

    // Close modal when pressing Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeImageModal();
        }
    });
</script>
@endsection
