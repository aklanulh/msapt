<!-- resources/views/admin/tasks/edit.blade.php -->
<x-layouts.admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Task
        </h2>
    </x-slot>

    <!-- Form untuk mengedit task -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('admin.tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <!-- Tambahkan input fields untuk mengedit task -->
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $task->title }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" class="form-control">{{ $task->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="points">Points:</label>
                        <input type="number" name="points" id="points" class="form-control" value="{{ $task->points }}">
                    </div>
                    <div class="form-group">
                        <label for="deadline">Deadline:</label>
                        <input type="datetime-local" name="deadline" id="deadline" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($task->deadline)) }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Task</button>
                    <a href="{{ route('admin.tasks.index') }}" class="btn btn-secondary">Cancel</a> <!-- Tambahkan tombol cancel -->
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
