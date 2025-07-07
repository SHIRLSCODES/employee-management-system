<x-admin-layout>
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">View Role: {{ $role->name }}</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('admin.dashboard') }}" class="text-slate-400 dark:text-zink-200">Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('admin.roles.index') }}" class="text-slate-400 dark:text-zink-200">Roles</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">{{ $role->name }}</li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">

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
                    setTimeout(() => {
                        document.getElementById('success-message')?.remove();
                        document.getElementById('error-message')?.remove();
                    }, 10000);
                </script>

                {{-- Role Info --}}
                <h6 class="text-lg font-semibold text-slate-800 dark:text-zink-50 mb-4">Role: {{ $role->name }}</h6>

                {{-- Current Permissions --}}
                <div class="mb-6">
                    <label class="block mb-2 font-medium text-slate-700 dark:text-zink-200">Current Permissions:</label>
                    <div class="flex flex-wrap gap-2">
                        @forelse($role->permissions as $permission)
                            <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium border border-blue-400 text-blue-600 dark:text-blue-300 dark:border-blue-600 rounded-full bg-transparent dark:bg-zink-800">
                                {{ $permission->name }}
                            </span>
                        @empty
                            <span class="text-sm text-slate-500 dark:text-zink-400">No permissions assigned.</span>
                        @endforelse
                    </div>
                </div>

                {{-- Update Permissions --}}
                <form method="POST" action="{{ route('admin.roles.permissions.assign', $role) }}">
                    @csrf
                    @method('PATCH')

                    <label class="block mb-2 font-medium text-slate-700 dark:text-zink-200">Update Permissions:</label>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-4">
                        @foreach ($permissions as $permission)
                            <label class="inline-flex items-center text-sm text-slate-700 dark:text-zink-200">
                                <input type="checkbox" name="permissions[]"
                                    value="{{ $permission->name }}"
                                    class="form-checkbox text-blue-500 mr-2"
                                    {{ $role->permissions->contains($permission) ? 'checked' : '' }}>
                                {{ $permission->name }}
                            </label>
                        @endforeach
                    </div>

                    <button type="submit"
                        class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 focus:ring focus:ring-custom-100">
                        Update Permissions
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-admin-layout>
