<!-- resources/views/admin/dashboard.blade.php -->

<x-layouts.admin>
    <div class="container-fluid">
        <h1 class="mt-4">Admin Dashboard</h1>

        <div class="row">
            <!-- Total Tasks -->
            <div class="col-md-4">
                <a href="{{ route('admin.tasks.index') }}" class="text-decoration-none text-dark">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-tasks"></i>
                            Total Tasks
                        </div>
                        <div class="card-body">
                            <h2 class="card-title">{{ $totalTasks }}</h2>
                            <p class="card-text">
                                Active: {{ $activeTasks }} | Expired: {{ $expiredTasks }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Total Submissions -->
            <div class="col-md-4">
                <a href="{{ route('admin.submissions') }}" class="text-decoration-none text-dark">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-file-alt"></i>
                            Total Submissions
                        </div>
                        <div class="card-body">
                            <h2 class="card-title">{{ $totalSubmissions }}</h2>
                            <p class="card-text">
                                Pending: {{ $pendingSubmissions }} | Approved: {{ $approvedSubmissions }} | Rejected: {{ $rejectedSubmissions }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Total Redeems -->
            <div class="col-md-4">
                <a href="{{ route('admin.redeems') }}" class="text-decoration-none text-dark">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-gift"></i>
                            Total Redeems
                        </div>
                        <div class="card-body">
                            <h2 class="card-title">{{ $totalRedeems }}</h2>
                            <p class="card-text">
                                Pending: {{ $pendingRedeems }} | Approved: {{ $approvedRedeems }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Tasks -->
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('admin.tasks.index') }}" class="text-decoration-none text-dark">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-tasks"></i>
                            Recent Tasks
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentTasks as $task)
                                        <tr>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ Str::limit($task->description, 40) }}</td>
                                            <td>{{ $task->points }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Recent Submissions -->
            <div class="col-md-6">
                <a href="{{ route('admin.submissions') }}" class="text-decoration-none text-dark">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-file-alt"></i>
                            Recent Submissions
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Task</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentSubmissions as $submission)
                                        <tr>
                                            <td>{{ $submission->user->name }}</td>
                                            <td>{{ $submission->task ? $submission->task->title : 'Task not found' }}</td>
                                            <td>{{ $submission->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-layouts.admin>
