<x-app-layout>
    <x-slot name="header">
        📋 Quest Progress - Track Your Adventures!
    </x-slot>

    @php
        $totalSubmissions = $pendingSubmissions->count() + $approvedRejectedSubmissions->count();
        $approvedCount = $approvedRejectedSubmissions->where('status', 'approve')->count();
        $rejectedCount = $approvedRejectedSubmissions->where('status', 'reject')->count();
        $pendingCount = $pendingSubmissions->count();
        $successRate = $totalSubmissions > 0 ? round(($approvedCount / $totalSubmissions) * 100) : 0;
    @endphp

    <!-- Progress Overview -->
    <div class="pixel-card pixel-fade-in" style="margin-bottom: 20px;">
        <div class="pixel-card-header">
            📊 Quest Progress Overview
        </div>
        <div class="pixel-grid">
            <div style="text-align: center;">
                <div class="pixel-badge pixel-badge-success pixel-pulse">
                    ✅ {{ $approvedCount }}
                </div>
                <div style="font-size: 8px; opacity: 0.7; margin-top: 5px;">Completed</div>
            </div>
            <div style="text-align: center;">
                <div class="pixel-badge pixel-badge-warning pixel-pulse">
                    ⏳ {{ $pendingCount }}
                </div>
                <div style="font-size: 8px; opacity: 0.7; margin-top: 5px;">Under Review</div>
            </div>
            <div style="text-align: center;">
                <div class="pixel-badge pixel-badge-danger">
                    ❌ {{ $rejectedCount }}
                </div>
                <div style="font-size: 8px; opacity: 0.7; margin-top: 5px;">Rejected</div>
            </div>
            <div style="text-align: center;">
                <div class="pixel-badge">
                    📈 {{ $successRate }}%
                </div>
                <div style="font-size: 8px; opacity: 0.7; margin-top: 5px;">Success Rate</div>
            </div>
        </div>
    </div>

    <!-- Pending Submissions -->
    @if($pendingSubmissions->count() > 0)
        <div class="pixel-card pixel-fade-in" style="margin-bottom: 20px;">
            <div class="pixel-card-header">
                ⏳ Quests Under Review ({{ $pendingCount }})
            </div>
            <div class="space-y-3">
                @foreach ($pendingSubmissions as $submission)
                    <div class="pixel-card" style="background: rgba(249, 202, 36, 0.1); border-color: var(--pixel-warning);">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 margin-bottom: 8px;">
                                    <span class="pixel-badge pixel-badge-warning">⏳ PENDING</span>
                                    <span style="font-size: 10px; opacity: 0.7;">{{ $submission->created_at->diffForHumans() }}</span>
                                </div>
                                <h4 style="margin: 8px 0; font-size: 12px;">🎮 {{ $submission->task->title ?? 'Quest #' . $submission->task_id }}</h4>
                                <p style="margin: 0; font-size: 9px; opacity: 0.8;">{{ Str::limit($submission->task->description ?? 'Quest description', 100) }}</p>
                                <div style="margin-top: 10px;">
                                    <span class="pixel-badge pixel-badge-success" style="font-size: 7px;">💎 {{ $submission->task->points ?? 0 }} Points</span>
                                </div>
                            </div>
                            <div style="text-align: right;">
                                <a href="{{ $submission->submission_url }}" target="_blank" class="pixel-btn" style="font-size: 8px; padding: 4px 8px; margin-bottom: 5px;">
                                    🔗 View Work
                                </a>
                                <a href="{{ route('tasks.show', $submission->task_id) }}" class="pixel-btn pixel-btn-secondary" style="font-size: 8px; padding: 4px 8px;">
                                    👁️ Quest Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Completed & Rejected Submissions -->
    @if($approvedRejectedSubmissions->count() > 0)
        <div class="pixel-card pixel-fade-in">
            <div class="pixel-card-header">
                📈 Quest History ({{ $approvedRejectedSubmissions->count() }})
            </div>
            <div class="space-y-3">
                @foreach ($approvedRejectedSubmissions as $submission)
                    @php
                        $isApproved = $submission->status === 'approve';
                        $cardBg = $isApproved ? 'rgba(108, 92, 231, 0.1)' : 'rgba(255, 107, 107, 0.1)';
                        $borderColor = $isApproved ? 'var(--pixel-success)' : 'var(--pixel-primary)';
                    @endphp
                    <div class="pixel-card" style="background: {{ $cardBg }}; border-color: {{ $borderColor }};">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 margin-bottom: 8px;">
                                    @if($isApproved)
                                        <span class="pixel-badge pixel-badge-success">✅ COMPLETED</span>
                                    @else
                                        <span class="pixel-badge pixel-badge-danger">❌ REJECTED</span>
                                    @endif
                                    <span style="font-size: 10px; opacity: 0.7;">{{ $submission->updated_at->diffForHumans() }}</span>
                                </div>
                                <h4 style="margin: 8px 0; font-size: 12px;">🎮 {{ $submission->task->title ?? 'Quest #' . $submission->task_id }}</h4>
                                <p style="margin: 0; font-size: 9px; opacity: 0.8;">{{ Str::limit($submission->task->description ?? 'Quest description', 100) }}</p>
                                <div style="margin-top: 10px;">
                                    @if($isApproved)
                                        <span class="pixel-badge pixel-badge-success" style="font-size: 7px;">💎 +{{ $submission->task->points ?? 0 }} Points Earned!</span>
                                    @else
                                        <span class="pixel-badge pixel-badge-danger" style="font-size: 7px;">💎 {{ $submission->task->points ?? 0 }} Points (Not Earned)</span>
                                    @endif
                                </div>
                            </div>
                            <div style="text-align: right;">
                                <a href="{{ $submission->submission_url }}" target="_blank" class="pixel-btn" style="font-size: 8px; padding: 4px 8px; margin-bottom: 5px;">
                                    🔗 View Work
                                </a>
                                @if(!$isApproved)
                                    <a href="{{ route('tasks.show', $submission->task_id) }}" class="pixel-btn pixel-btn-warning" style="font-size: 8px; padding: 4px 8px;">
                                        🔄 Try Again
                                    </a>
                                @else
                                    <a href="{{ route('tasks.show', $submission->task_id) }}" class="pixel-btn pixel-btn-secondary" style="font-size: 8px; padding: 4px 8px;">
                                        👁️ Quest Details
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Empty State -->
    @if($totalSubmissions == 0)
        <div class="pixel-card pixel-fade-in" style="text-align: center;">
            <div class="pixel-card-header">
                📭 No Quest Progress Yet
            </div>
            <div style="padding: 40px;">
                <div style="font-size: 48px; margin-bottom: 20px;">🎯</div>
                <p style="margin: 0; font-size: 12px; line-height: 1.8;">
                    You haven't submitted any quests yet!<br>
                    Start your adventure by completing some quests! ✨
                </p>
                <div style="margin-top: 20px;">
                    <a href="{{ route('tasks.index') }}" class="pixel-btn pixel-btn-secondary">
                        ⚔️ Browse Quests
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Progress Tips -->
    <div class="pixel-card pixel-fade-in" style="margin-top: 20px;">
        <div class="pixel-card-header">
            💡 Progress Tips
        </div>
        <div class="space-y-2" style="font-size: 9px; line-height: 1.6;">
            <p>⏳ <strong>Pending submissions are being reviewed by quest masters!</strong></p>
            <p>✅ <strong>Completed quests earn you points immediately!</strong></p>
            <p>❌ <strong>Rejected submissions can be improved and resubmitted!</strong></p>
            <p>📈 <strong>Higher success rate shows your quest mastery!</strong></p>
        </div>
    </div>
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
