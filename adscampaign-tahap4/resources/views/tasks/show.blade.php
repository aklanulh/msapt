<x-app-layout>
    <x-slot name="header">
        🎮 Quest Details - {{ $task->title }}
    </x-slot>

    @php
        $isCompleted = Auth::user()->submissions()->where('task_id', $task->id)->where('status', 'approve')->exists();
        $isPending = Auth::user()->submissions()->where('task_id', $task->id)->where('status', 'pending')->exists();
        $isRejected = Auth::user()->submissions()->where('task_id', $task->id)->where('status', 'reject')->exists();
        $existingSubmission = Auth::user()->submissions()->where('task_id', $task->id)->first();
        $deadline = \Carbon\Carbon::parse($task->deadline);
        $isExpired = $deadline->isPast();
        $daysLeft = $deadline->diffInDays(now());
        $difficulty = $task->points >= 100 ? 'LEGENDARY' : ($task->points >= 50 ? 'EPIC' : ($task->points >= 25 ? 'RARE' : 'COMMON'));
        $difficultyColor = $task->points >= 100 ? 'pixel-badge-danger' : ($task->points >= 50 ? 'pixel-badge-success' : ($task->points >= 25 ? 'pixel-badge-warning' : 'pixel-badge'));
    @endphp

    <div class="pixel-grid">
        <!-- Quest Information Card -->
        <div class="pixel-card pixel-fade-in {{ $isCompleted ? 'pixel-glow' : '' }}" style="grid-column: 1 / -1; position: relative;">
            
            <!-- Quest Status Badge -->
            @if($isCompleted)
                <div class="pixel-badge pixel-badge-success pixel-pulse" style="position: absolute; top: -10px; right: -10px; z-index: 10;">
                    ✅ QUEST COMPLETED!
                </div>
            @elseif($isPending)
                <div class="pixel-badge pixel-badge-warning pixel-pulse" style="position: absolute; top: -10px; right: -10px; z-index: 10;">
                    ⏳ UNDER REVIEW
                </div>
            @elseif($isRejected)
                <div class="pixel-badge pixel-badge-danger" style="position: absolute; top: -10px; right: -10px; z-index: 10;">
                    ❌ REJECTED
                </div>
            @elseif($isExpired)
                <div class="pixel-badge" style="position: absolute; top: -10px; right: -10px; z-index: 10; background: #666;">
                    💀 EXPIRED
                </div>
            @else
                <div class="pixel-badge pixel-badge-success pixel-pulse" style="position: absolute; top: -10px; right: -10px; z-index: 10;">
                    🚀 READY TO START
                </div>
            @endif

            <div class="pixel-card-header">
                ⚔️ {{ $task->title }}
            </div>
            
            <!-- Quest Stats Row -->
            <div class="pixel-grid" style="margin-bottom: 20px;">
                <div style="text-align: center;">
                    <div class="pixel-badge pixel-badge-warning" style="width: 100%; margin-bottom: 5px;">
                        💎 {{ $task->points }} POINTS
                    </div>
                    <div style="font-size: 8px; opacity: 0.7;">Reward</div>
                </div>
                
                <div style="text-align: center;">
                    <div class="pixel-badge {{ $difficultyColor }}" style="width: 100%; margin-bottom: 5px;">
                        ⭐ {{ $difficulty }}
                    </div>
                    <div style="font-size: 8px; opacity: 0.7;">Difficulty</div>
                </div>
                
                <div style="text-align: center;">
                    <div class="pixel-badge" style="width: 100%; margin-bottom: 5px; font-size: 8px;">
                        @if($isExpired)
                            💀 EXPIRED
                        @elseif($daysLeft == 0)
                            🔥 LAST DAY!
                        @elseif($daysLeft <= 3)
                            ⚡ {{ $daysLeft }} DAYS LEFT
                        @else
                            📅 {{ $daysLeft }} DAYS LEFT
                        @endif
                    </div>
                    <div style="font-size: 8px; opacity: 0.7;">Deadline</div>
                </div>
            </div>
            
            <!-- Quest Description -->
            <div style="background: rgba(255,255,255,0.05); padding: 15px; border: 2px solid var(--pixel-light); margin-bottom: 20px;">
                <h4 style="margin: 0 0 10px 0; font-size: 12px; color: var(--pixel-accent);">📜 Quest Briefing:</h4>
                <p style="margin: 0; font-size: 10px; line-height: 1.8;">{{ $task->description }}</p>
            </div>
            
            <!-- Deadline Info -->
            <div style="background: rgba(255,255,255,0.05); padding: 15px; border: 2px solid var(--pixel-warning); margin-bottom: 20px;">
                <h4 style="margin: 0 0 10px 0; font-size: 12px; color: var(--pixel-warning);">⏰ Quest Deadline:</h4>
                <p style="margin: 0; font-size: 10px;">
                    <strong>{{ $deadline->format('F j, Y \a\t g:i A') }}</strong><br>
                    <span style="opacity: 0.7;">({{ $deadline->diffForHumans() }})</span>
                </p>
            </div>
        </div>

        <!-- Submission Status Card -->
        @if($existingSubmission)
            <div class="pixel-card pixel-fade-in">
                <div class="pixel-card-header">
                    📋 Your Submission
                </div>
                <div class="space-y-3">
                    <div>
                        <strong style="font-size: 10px;">Submission URL:</strong><br>
                        <a href="{{ $existingSubmission->submission_url }}" target="_blank" class="pixel-btn" style="font-size: 8px; padding: 4px 8px; margin-top: 5px;">
                            🔗 View Submission
                        </a>
                    </div>
                    
                    <div>
                        <strong style="font-size: 10px;">Status:</strong><br>
                        <span class="pixel-badge 
                            @if($existingSubmission->status === 'approve') pixel-badge-success
                            @elseif($existingSubmission->status === 'reject') pixel-badge-danger
                            @else pixel-badge-warning
                            @endif" style="margin-top: 5px;">
                            @if($existingSubmission->status === 'approve')
                                ✅ APPROVED - Quest Complete!
                            @elseif($existingSubmission->status === 'reject')
                                ❌ REJECTED - Try Again
                            @else
                                ⏳ PENDING REVIEW
                            @endif
                        </span>
                    </div>
                    
                    <div style="font-size: 8px; opacity: 0.7;">
                        Submitted: {{ $existingSubmission->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        @endif

        <!-- Submission Form Card -->
        @if(!$isCompleted && !$isExpired)
            <div class="pixel-card pixel-fade-in">
                <div class="pixel-card-header">
                    @if($existingSubmission && $existingSubmission->status === 'reject')
                        🔄 Resubmit Quest
                    @elseif($existingSubmission)
                        ✏️ Update Submission
                    @else
                        🚀 Submit Quest
                    @endif
                </div>
                
                @if($existingSubmission && $existingSubmission->status === 'pending')
                    <div style="text-align: center; padding: 20px; opacity: 0.7;">
                        <div style="font-size: 24px; margin-bottom: 10px;">⏳</div>
                        <p style="margin: 0; font-size: 10px;">Your submission is under review!<br>Please wait for the results.</p>
                    </div>
                @else
                    <form action="{{ route('submissions.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        
                        <div>
                            <label for="submission_url" style="display: block; font-size: 10px; margin-bottom: 8px; color: var(--pixel-accent);">
                                🔗 Submission URL *
                            </label>
                            <input type="url" 
                                   name="submission_url" 
                                   id="submission_url" 
                                   required 
                                   class="pixel-input"
                                   placeholder="https://your-submission-link.com"
                                   value="{{ $existingSubmission ? $existingSubmission->submission_url : old('submission_url') }}">
                            @error('submission_url')
                                <div style="color: var(--pixel-primary); font-size: 8px; margin-top: 5px;">
                                    ❌ {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div style="background: rgba(255,255,255,0.05); padding: 10px; border: 1px solid var(--pixel-accent); font-size: 8px; line-height: 1.6;">
                            💡 <strong>Submission Tips:</strong><br>
                            • Make sure your URL is accessible<br>
                            • Double-check your work before submitting<br>
                            • Follow the quest requirements carefully
                        </div>
                        
                        <div style="text-align: center;">
                            <button type="submit" class="pixel-btn pixel-btn-success" style="width: 100%;">
                                @if($existingSubmission)
                                    🔄 Update Submission
                                @else
                                    🚀 Submit Quest
                                @endif
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        @elseif($isCompleted)
            <div class="pixel-card pixel-fade-in pixel-glow" style="text-align: center;">
                <div class="pixel-card-header">
                    🏆 Quest Completed!
                </div>
                <div style="padding: 20px;">
                    <div style="font-size: 48px; margin-bottom: 15px;">🎉</div>
                    <p style="margin: 0; font-size: 12px; line-height: 1.8;">
                        Congratulations, warrior!<br>
                        You've earned <strong>{{ $task->points }} points</strong>! 💎
                    </p>
                </div>
            </div>
        @elseif($isExpired)
            <div class="pixel-card pixel-fade-in" style="text-align: center; opacity: 0.7;">
                <div class="pixel-card-header">
                    💀 Quest Expired
                </div>
                <div style="padding: 20px;">
                    <div style="font-size: 48px; margin-bottom: 15px;">⏰</div>
                    <p style="margin: 0; font-size: 12px; line-height: 1.8;">
                        This quest has expired and can no longer be completed.<br>
                        Check out other available quests!
                    </p>
                </div>
            </div>
        @endif
    </div>

    <!-- Navigation -->
    <div style="text-align: center; margin-top: 20px;">
        <a href="{{ route('tasks.index') }}" class="pixel-btn pixel-btn-secondary">
            ← Back to Quest Board
        </a>
    </div>
</x-app-layout>
