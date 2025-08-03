<x-app-layout>
    <x-slot name="header">
        🏠 Player Base - Welcome Back, {{ Auth::user()->name }}!
    </x-slot>

    <div class="pixel-grid">
        <!-- Player Stats Card -->
        <div class="pixel-card pixel-fade-in">
            <div class="pixel-card-header">
                📊 Player Statistics
            </div>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span>💎 Total Points:</span>
                    <span class="pixel-badge pixel-badge-success pixel-pulse">{{ Auth::user()->points ?? 0 }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span>⚔️ Quests Completed:</span>
                    <span class="pixel-badge pixel-badge-warning">{{ Auth::user()->submissions()->where('status', 'approve')->count() }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span>📋 Pending Submissions:</span>
                    <span class="pixel-badge">{{ Auth::user()->submissions()->where('status', 'pending')->count() }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span>💰 Total Redeemed:</span>
                    <span class="pixel-badge pixel-badge-success">{{ Auth::user()->redeems()->where('status', 'approve')->sum('amount') ?? 0 }}</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions Card -->
        <div class="pixel-card pixel-fade-in">
            <div class="pixel-card-header">
                🚀 Quick Actions
            </div>
            <div class="space-y-3">
                <a href="{{ route('tasks.index') }}" class="pixel-btn pixel-btn-secondary" style="width: 100%; text-align: center; display: block;">
                    ⚔️ Browse Quests
                </a>
                <a href="{{ route('submissions.index') }}" class="pixel-btn" style="width: 100%; text-align: center; display: block;">
                    📋 View Progress
                </a>
                <a href="{{ route('redeems.index') }}" class="pixel-btn pixel-btn-warning" style="width: 100%; text-align: center; display: block;">
                    💰 Redeem Points
                </a>
            </div>
        </div>

        <!-- Recent Activity Card -->
        <div class="pixel-card pixel-fade-in">
            <div class="pixel-card-header">
                📈 Recent Activity
            </div>
            <div class="space-y-2">
                @php
                    $recentSubmissions = Auth::user()->submissions()->latest()->take(3)->get();
                @endphp
                @forelse($recentSubmissions as $submission)
                    <div class="flex justify-between items-center" style="padding: 8px; background: rgba(255,255,255,0.05); border: 1px solid var(--pixel-light);">
                        <span style="font-size: 8px;">{{ $submission->task->title ?? 'Quest' }}</span>
                        <span class="pixel-badge 
                            @if($submission->status === 'approve') pixel-badge-success
                            @elseif($submission->status === 'reject') pixel-badge-danger
                            @else pixel-badge-warning
                            @endif">
                            @if($submission->status === 'approve') ✅
                            @elseif($submission->status === 'reject') ❌
                            @else ⏳
                            @endif
                        </span>
                    </div>
                @empty
                    <div style="text-align: center; opacity: 0.7; font-size: 10px; padding: 20px;">
                        🎯 No quests completed yet!<br>
                        Start your adventure now!
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Achievement Card -->
        <div class="pixel-card pixel-fade-in pixel-float">
            <div class="pixel-card-header">
                🏆 Achievements
            </div>
            <div class="space-y-2">
                @php
                    $completedQuests = Auth::user()->submissions()->where('status', 'approve')->count();
                    $totalPoints = Auth::user()->points ?? 0;
                @endphp
                
                @if($completedQuests >= 1)
                    <div class="pixel-badge pixel-badge-success" style="width: 100%; text-align: center;">
                        🌟 First Quest Completed!
                    </div>
                @endif
                
                @if($completedQuests >= 5)
                    <div class="pixel-badge pixel-badge-success" style="width: 100%; text-align: center;">
                        🔥 Quest Master!
                    </div>
                @endif
                
                @if($totalPoints >= 100)
                    <div class="pixel-badge pixel-badge-success" style="width: 100%; text-align: center;">
                        💎 Point Collector!
                    </div>
                @endif
                
                @if($completedQuests == 0 && $totalPoints == 0)
                    <div style="text-align: center; opacity: 0.7; font-size: 10px; padding: 20px;">
                        🎮 Complete quests to unlock achievements!
                    </div>
                @endif
            </div>
        </div>

        <!-- Progress Bar Card -->
        <div class="pixel-card pixel-fade-in" style="grid-column: 1 / -1;">
            <div class="pixel-card-header">
                📊 Level Progress
            </div>
            @php
                $currentLevel = floor($totalPoints / 100) + 1;
                $pointsInLevel = $totalPoints % 100;
                $progressPercent = $pointsInLevel;
            @endphp
            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <span>Level {{ $currentLevel }}</span>
                    <span>{{ $pointsInLevel }}/100 XP</span>
                </div>
                <div class="pixel-progress">
                    <div class="pixel-progress-bar" style="width: {{ $progressPercent }}%;"></div>
                </div>
                <div style="text-align: center; font-size: 8px; opacity: 0.7;">
                    {{ 100 - $pointsInLevel }} points to next level!
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Message -->
    <div class="pixel-card pixel-glow" style="margin-top: 20px; text-align: center;">
        <div class="pixel-card-header">
            🎮 Welcome to Pixel Quest!
        </div>
        <p style="margin: 0; font-size: 10px; line-height: 1.8;">
            Complete quests, earn points, and redeem awesome rewards!<br>
            Your adventure starts here, brave warrior! 🗡️✨
        </p>
    </div>
</x-app-layout>
