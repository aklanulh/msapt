<!-- admin/tasks.blade.php -->
<x-layouts.admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Manage Tasks
        </h2>
    </x-slot>

    <!-- Konten Manage Tasks di sini -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('admin.tasks.create') }}" class="btn btn-primary">Create Task</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Points</th>
                            <th>Deadline</th>
                            <th>Action</th> <!-- Tambahkan kolom untuk aksi -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($task->description, 50) }}</td> <!-- Umpetkan deskripsi -->
                                <td>{{ $task->points }}</td>
                                <td>{{ $task->deadline }}</td>
                                <td>
                                    <a href="{{ route('admin.tasks.edit', $task->id) }}" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a> <!-- Tambahkan tombol Edit -->
                                    <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete" title="Delete" data-toggle="tooltip" style="border: none; background-color: transparent; cursor: pointer;"><i class="material-icons">&#xE872;</i></button> <!-- Tambahkan tombol Delete -->
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

   <!-- Tabel untuk task yang sudah expired -->
@if($expiredTasks->isNotEmpty())
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h3>Expired Tasks</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Points</th>
                        <th>Deadline</th>
                        <th>Action</th> <!-- Tambahkan kolom untuk aksi -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($expiredTasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($task->description, 50) }}</td>
                            <td>{{ $task->points }}</td>
                            <td>{{ $task->deadline }}</td>
                            <td>
                                <a href="{{ route('admin.tasks.edit', $task->id) }}" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a> <!-- Tombol Edit -->
                                <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete" title="Delete" data-toggle="tooltip" style="border: none; background-color: transparent; cursor: pointer;"><i class="material-icons">&#xE872;</i></button> <!-- Tombol Delete -->
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

</x-layouts.admin>
