<!-- resources/views/admin/tasks/create.blade.php -->
<x-layouts.admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create New Task
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('admin.tasks.store') }}">
                    @csrf
                
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                    </div>
                
                    <div class="form-group">
                        <label for="points">Points:</label>
                        <input type="number" name="points" id="points" class="form-control" required>
                    </div>
                
                    <div class="form-group">
                        <label for="deadline">Deadline:</label>
                        <input type="datetime-local" name="deadline" id="deadline" class="form-control" required>
                    </div>
                
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                
            </div>
        </div>
    </div>
</x-layouts.admin>
