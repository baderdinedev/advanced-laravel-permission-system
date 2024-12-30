<x-admin-layout>
    <div class="py-12 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">Edit Role</h1>

                    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Role Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $role->name) }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Description</label>
                                <textarea id="description" name="description" rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 @error('description') border-red-500 @enderror">{{ old('description', $role->description) }}</textarea>
                                @error('description')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Permissions -->
                            <div>
                                <label for="permissions" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Assign Permissions</label>
                                <select id="permissions" name="permissions[]" multiple required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 @error('permissions') border-red-500 @enderror">
                                    @foreach($permissions as $permission)
                                        <option value="{{ $permission->id }}"
                                            @if(in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray()))) selected @endif>
                                            {{ $permission->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('permissions')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <button type="submit" class="w-full inline-flex justify-center py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-blue-400">
                                    Update Role
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<style>

    .select2-container .select2-selection--single .select2-selection__rendered {
        color: #333;
    }

    .select2-container .select2-results__option {
        color: #333;
    }

    .select2-container .select2-selection--multiple .select2-selection__rendered {
        color: #333;
    }
</style>

<!-- Load jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script>
    $(document).ready(function() {
        $('#permissions').select2({
            placeholder: "Select Permissions",
            allowClear: true
        });
    });
</script>

