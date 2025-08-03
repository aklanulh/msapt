<x-app-layout>
    <x-slot name="header">
        ⚔️ Quest Board - Choose Your Adventure!
    </x-slot>

    @if ($tasks->count() > 0)
        <!-- Quest Stats Header -->
        <div class="pixel-card pixel-fade-in" style="margin-bottom: 20px; text-align: center;">
            <div class="pixel-card-header">
                🎯 Available Quests
            </div>
            <p style="margin: 0; font-size: 10px;">
                {{ $tasks->count() }} epic quests await your skills! Each quest rewards you with precious points! 💎
            </p>
        </div>

        <div class="pixel-grid">
            @foreach ($tasks as $task)
                @php
                    $isCompleted = Auth::user()->submissions()->where('task_id', $task->id)->where('status', 'approve')->exists();
                    $isPending = Auth::user()->submissions()->where('task_id', $task->id)->where('status', 'pending')->exists();
                    $isRejected = Auth::user()->submissions()->where('task_id', $task->id)->where('status', 'reject')->exists();
                    $deadline = \Carbon\Carbon::parse($task->deadline);
                    $isExpired = $deadline->isPast();
                    $daysLeft = $deadline->diffInDays(now());
                @endphp
                
                <div class="pixel-card pixel-fade-in {{ $isCompleted ? 'pixel-glow' : '' }}" 
                     style="position: relative; {{ $isExpired ? 'opacity: 0.6;' : '' }}">
                    
                    <!-- Quest Status Badge -->
                    @if($isCompleted)
                        <div class="pixel-badge pixel-badge-success" style="position: absolute; top: -10px; right: -10px; z-index: 10;">
                            ✅ COMPLETED
                        </div>
                    @elseif($isPending)
                        <div class="pixel-badge pixel-badge-warning" style="position: absolute; top: -10px; right: -10px; z-index: 10;">
                            ⏳ PENDING
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
                            🆕 NEW
                        </div>
                    @endif

                    <div class="pixel-card-header">
                        🎮 {{ $task->title }}
                    </div>
                    
                    <div class="space-y-3">
                        <p style="font-size: 9px; line-height: 1.6; margin: 0;">
                            {{ Str::limit($task->description, 120) }}
                        </p>
                        
                        <!-- Quest Rewards -->
                        <div class="flex justify-between items-center">
                            <span class="pixel-badge pixel-badge-warning">
                                💎 {{ $task->points }} Points
                            </span>
                            <span class="pixel-badge" style="font-size: 7px;">
                                @if($isExpired)
                                    💀 Expired
                                @elseif($daysLeft == 0)
                                    🔥 Last Day!
                                @elseif($daysLeft <= 3)
                                    ⚡ {{ $daysLeft }} days left
                                @else
                                    📅 {{ $daysLeft }} days left
                                @endif
                            </span>
                        </div>
                        
                        <!-- Quest Difficulty -->
                        <div class="flex items-center justify-center">
                            @php
                                $difficulty = $task->points >= 100 ? 'LEGENDARY' : ($task->points >= 50 ? 'EPIC' : ($task->points >= 25 ? 'RARE' : 'COMMON'));
                                $difficultyColor = $task->points >= 100 ? 'pixel-badge-danger' : ($task->points >= 50 ? 'pixel-badge-success' : ($task->points >= 25 ? 'pixel-badge-warning' : 'pixel-badge'));
                            @endphp
                            <span class="pixel-badge {{ $difficultyColor }}" style="font-size: 7px;">
                                ⭐ {{ $difficulty }}
                            </span>
                        </div>
                        
                        <!-- Action Button -->
                        <div style="text-align: center; margin-top: 15px;">
                            @if($isCompleted)
                                <span class="pixel-btn pixel-btn-success" style="cursor: default; opacity: 0.8;">
                                    🏆 Quest Complete!
                                </span>
                            @elseif($isExpired)
                                <span class="pixel-btn" style="cursor: default; opacity: 0.5; background: #666;">
                                    💀 Quest Expired
                                </span>
                            @else
                                <a href="{{ route('tasks.show', $task->id) }}" class="pixel-btn pixel-btn-secondary">
                                    @if($isPending)
                                        👁️ View Submission
                                    @elseif($isRejected)
                                        🔄 Try Again
                                    @else
                                        🚀 Start Quest
                                    @endif
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- No Quests Available -->
        <div class="pixel-card pixel-fade-in" style="text-align: center;">
            <div class="pixel-card-header">
                📭 No Quests Available
            </div>
            <div style="padding: 40px;">
                <div style="font-size: 48px; margin-bottom: 20px;">🎮</div>
                <p style="margin: 0; font-size: 12px; line-height: 1.8;">
                    No epic quests are available right now!<br>
                    Check back later for new adventures! ✨
                </p>
                <div style="margin-top: 20px;">
                    <a href="{{ route('dashboard') }}" class="pixel-btn pixel-btn-secondary">
                        🏠 Return to Base
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Quest Tips -->
    <div class="pixel-card pixel-fade-in" style="margin-top: 20px;">
        <div class="pixel-card-header">
            💡 Quest Master Tips
        </div>
        <div class="space-y-2" style="font-size: 9px; line-height: 1.6;">
            <p>🎯 <strong>Complete quests to earn points and level up!</strong></p>
            <p>⚡ <strong>Higher difficulty quests give more points!</strong></p>
            <p>📅 <strong>Watch the deadlines - expired quests can't be completed!</strong></p>
            <p>💎 <strong>Use your points to redeem amazing rewards!</strong></p>
        </div>
    </div>
</x-app-layout>
