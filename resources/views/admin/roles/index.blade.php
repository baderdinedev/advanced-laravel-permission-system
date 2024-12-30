<x-admin-layout>
    <div class="py-12 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Page Title -->
                    <h1 class="text-2xl font-bold mb-6">Roles</h1>
                    @if (session('success'))
                    <x-alert type="success" :message="session('success')" />
                    @endif

                    @if (session('error'))
                        <x-alert type="error" :message="session('error')" />
                    @endif
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('admin.roles.create') }}"
                           class="inline-flex items-center px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-blue-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1-1z" clip-rule="evenodd" />
                            </svg>
                            Add Role
                        </a>
                    </div>

                    <!-- Roles Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-sm uppercase">
                                <tr>
                                    <th class="px-6 py-3 text-left font-medium">Role Name</th>
                                    <th class="px-6 py-3 text-left font-medium">Permissions</th>
                                    <th class="px-6 py-3 text-right font-medium">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                                @foreach($roles as $role)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <!-- Role Name -->
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 font-medium">
                                            {{ $role->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            @foreach($role->permissions as $permission)
                                                <span class="inline-block px-2 py-1 text-xs font-semibold text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700 rounded-md mb-1 mr-1">
                                                    {{ $permission->name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <!-- Actions -->
                                        <td class="px-6 py-4 text-right text-sm">
                                            <a href="{{ route('admin.roles.edit', $role->id) }}"
                                               class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600 mr-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-4.036a2.5 2.5 0 113.536 3.536L6.5 21H3v-3.5L16.732 3.732z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-600"
                                                        onclick="return confirm('Are you sure?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
