<x-admin-layout>
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Edit Role Name</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('admin.dashboard') }}" class="text-slate-400 dark:text-zink-200">Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('admin.roles.index') }}" class="text-slate-400 dark:text-zink-200">Roles</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">Edit</li>
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

                {{-- Edit Role Name Only --}}
                <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-slate-700 dark:text-zink-200">Role Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}" required
                               class="w-full px-4 py-2 border border-gray-300 dark:border-zink-600 rounded-md bg-transparent text-slate-800 dark:text-white focus:ring focus:ring-blue-500">
                    </div>

                    <button type="submit"
                            class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 focus:ring focus:ring-custom-100">
                        Save Changes
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
