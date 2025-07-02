<x-admin-layout>
    <div class="container mx-auto py-8">
        <div class="p-6 bg-transparent dark:bg-transparent rounded-xl shadow">

            <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">Assign Roles</h1>

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

            {{-- Admin Role Assignment --}}
            <div class="mb-8 p-6 border border-gray-300 dark:border-gray-700 rounded bg-gray-50 dark:bg-gray-900 shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Assign Role to Admin</h2>
                <form method="POST" action="{{ route('admin.roles.assign.update') }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="user_type" value="admin">

                    <div class="flex flex-col md:flex-nowrap md:flex-row md:items-end gap-4 mb-4">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">Search Admin</label>
                            <x-select-input id="admin-select" name="user_id" required class="w-full dark:bg-transparent dark:text-white">
                                <option value="">Select Admin:</option>
                                @foreach ($admins as $admin)
                                    <option value="{{ $admin->id }}">
                                        {{ $admin->name }} ({{ $admin->email }})
                                    </option>
                                @endforeach
                            </x-select-input>
                        </div>

                        <div class="flex-1">
                            <label class="mt-2 block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">Role</label>
                            <x-select-input name="role" required class="w-full dark:bg-gray-800 dark:text-white">
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </x-select-input>
                        </div>

                        <div class="flex items-end">
                            <button type="submit"
                                class="mt-6 mb-2 text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:ring focus:ring-custom-100 dark:ring-custom-400/20">
                                Assign Role
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Employee Role Assignment --}}
            <div class="p-6 border border-gray-300 dark:border-gray-700 rounded bg-gray-50 dark:bg-gray-900 shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Assign Role to Employee</h2>
                <form method="POST" action="{{ route('admin.roles.assign.update') }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="user_type" value="employee">

                    <div class="flex flex-col md:flex-row md:items-center gap-4 mb-4">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">Search Employee</label>
                            <x-select-input id="employee-select" name="user_id" required class="w-full dark:bg-gray-800 dark:text-white">
                                <option value="">Select Employee:</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">
                                        {{ $employee->first_name }} {{ $employee->last_name }} ({{ $employee->email }})
                                    </option>
                                @endforeach
                            </x-select-input>
                        </div>

                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">Role</label>
                            <x-select-input name="role" required class="w-full dark:bg-gray-800 dark:text-white">
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </x-select-input>
                        </div>

                        <div class="flex items-end">
                            <button type="submit"
                                class="mt-6 text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:ring focus:ring-custom-100 dark:ring-custom-400/20">
                                Assign Role
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new TomSelect('#admin-select', {
                placeholder: "Select an admin...",
                allowEmptyOption: true,
            });

            new TomSelect('#employee-select', {
                placeholder: "Select an employee...",
                allowEmptyOption: true,
            });
        });
    </script>

</x-admin-layout>
