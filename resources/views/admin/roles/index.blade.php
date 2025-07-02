<x-admin-layout>
    <div class="container mx-auto py-8">
        <div class="p-6 bg-transparent dark:bg-transparent rounded-xl shadow">
            <h1 class="text-2xl font-bold text-gray-700 dark:text-gray-300 mb-6">Role & Permission Setup</h1>

            {{-- Flash Messages --}}
            @if (session('success'))
                <div id="success-message" class="mb-4 p-4 bg-green-500 text-white rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div id="error-message" class="mb-4 p-3 bg-red-600 text-white rounded-md">
                    {{ session('error') }}
                </div>
            @endif
            <script>
                setTimeout(function () {
                    document.getElementById('success-message')?.remove();
                    document.getElementById('error-message')?.remove();
                }, 10000);
            </script>

            {{-- Create Role --}}
            <form action="{{ route('admin.roles.store') }}" method="POST" class="mb-8">
                @csrf
                <label class="block text-gray-700 dark:text-gray-300 mb-2 font-semibold">New Role Name</label>
                <div class="flex space-x-4 items-start">
                    <input type="text" name="name" required
                        class="w-1/3 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded bg-transparent text-black dark:text-white focus:ring focus:ring-blue-500">
                    <button type="submit"
                        class="ml-2 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                        Create Role
                    </button>
                </div>
            </form>

            {{-- Create Permission --}}
            <form action="{{ route('admin.roles.permissions.store') }}" method="POST" class="mb-8">
                @csrf
                <label class="block text-gray-700 dark:text-gray-300 mb-2 font-semibold">New Permission Name</label>
                <div class="flex space-x-4">
                    <input type="text" name="name" required
                        class="w-1/3 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded bg-transparent text-black dark:text-white focus:ring focus:ring-blue-500">
                    <button type="submit"
                        class="ml-2 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                        Create Permission
                    </button>
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </form>

            {{-- Existing Roles and Permission assignment --}}
            <div>
                @foreach ($roles as $role)
                    <div class="mb-6 p-4 border border-gray-300 dark:border-gray-700 rounded shadow bg-gray-50 dark:bg-gray-900">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">{{ $role->name }}</h2>
                        {{-- Assign Permissions --}}
                        <form method="POST" action="{{ route('admin.roles.permissions.assign', $role) }}">
                            @csrf
                            @method('PATCH')
                            <label class="block mb-2 text-gray-700 dark:text-gray-300 font-medium">Assign Permissions:</label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-3">
                                @foreach ($permissions as $permission)
                                    <label class="inline-flex items-center text-sm text-gray-600 dark:text-gray-300">
                                        <input type="checkbox" name="permissions[]"
                                            value="{{ $permission->name }}"
                                            class="form-checkbox text-blue-500 mr-2"
                                            {{ $role->permissions->contains($permission) ? 'checked' : '' }}>
                                        {{ $permission->name }}
                                    </label>
                                @endforeach
                            </div>
                            <button type="submit"
                                class="ml-2 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                Update Permissions
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-admin-layout>
