<!-- resources/views/admin/submissions.blade.php -->
<x-layouts.admin>
    <!-- Konten Manage Submissions di sini -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h3>Pending Submissions</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th><a href="{{ route('admin.submissions', ['sort' => 'user_id', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}">User ID</a></th>
                            <th><a href="{{ route('admin.submissions', ['sort' => 'task_id', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}">Task ID</a></th>
                            <th>Submission URL</th>
                            <th>Status</th>
                            <th>Action</th> <!-- Menambahkan kolom untuk aksi -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingSubmissions as $submission)
                            <tr>
                                <td>{{ $submission->user_id }}</td>
                                <td>{{ $submission->task_id }}</td>
                                <td>
                                    <a href="{{ $submission->submission_url }}" class="btn btn-primary" target="_blank">Open URL</a>
                                </td>
                                <td>{{ $submission->status }}</td>
                                <td>
                                    <form action="{{ route('approve-submission', $submission->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">
                                            <i class="material-icons">check</i>
                                        </button>
                                    </form>
                                    <form action="{{ route('reject-submission', $submission->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Approved/Rejected Submissions</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th><a href="{{ route('admin.submissions', ['sort' => 'user_id', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}">User ID</a></th>
                            <th><a href="{{ route('admin.submissions', ['sort' => 'task_id', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}">Task ID</a></th>
                            <th>Submission URL</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($actionSubmissions as $submission)
                            <tr>
                                <td>{{ $submission->user_id }}</td>
                                <td>{{ $submission->task_id }}</td>
                                <td>
                                    <a href="{{ $submission->submission_url }}" class="btn btn-primary" target="_blank">Open URL</a>
                                </td>
                                <td>{{ $submission->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.admin>
