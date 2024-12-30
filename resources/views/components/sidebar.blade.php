<aside class="w-64 bg-gray-100 dark:bg-gray-900 h-full fixed">
    <div class="py-4 px-3">
        <!-- Logo -->
        <div class="mb-5">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <x-application-logo class="h-10 w-auto fill-current text-gray-800 dark:text-gray-200" />
                <span class="text-xl font-bold ml-2 text-gray-800 dark:text-gray-200">Logo</span>
            </a>
        </div>

        <!-- Navigation Links -->
        <ul class="space-y-2">
            @role('admin')
            <li>
                <a href="{{ route('admin.index') }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">
                    <span class="ml-3">Dashbord</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.roles.index') }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">
                    <span class="ml-3">Roles</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.permissions.index') }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">
                    <span class="ml-3">Permissions</span>
                </a>
            </li>
            @endrole

            <!-- User Links -->
            <li>
                <a href="{{ route('profile.edit') }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">
                    <span class="ml-3">Profile</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">
                        <span class="ml-3">Log Out</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
