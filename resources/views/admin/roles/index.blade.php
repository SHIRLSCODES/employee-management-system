<x-admin-layout>
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <!-- Header -->
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Role Setup</h5>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <!-- Flash Messages -->
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

                <!-- Create New Role -->
                <form action="{{ route('admin.roles.store') }}" method="POST" class="mb-6">
                    @csrf
                    <label class="block text-gray-700 dark:text-gray-300 mb-2 font-semibold">New Role Name</label>
                    <div class="flex space-x-4 items-start">
                        <input type="text" name="name" required
                            class="w-1/3 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded bg-transparent text-black dark:text-white focus:ring focus:ring-blue-500">
                        <button type="submit"
                            class="ml-2 text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 focus:ring focus:ring-custom-100">
                            Create Role
                        </button>
                    </div>
                </form>

                <!-- Roles Table -->
                <div class="overflow-x-auto">
                    <table class="w-full table-auto whitespace-nowrap">
                        <thead class="bg-slate-100 text-slate-500 dark:bg-zink-600 dark:text-zink-200">
                            <tr>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 text-left">#</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 text-left">Role</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                                <tr class="border-b border-slate-200 dark:border-zink-500">
                                    <td class="px-3.5 py-2.5 align-top">{{ $loop->iteration }}</td>
                                    <td class="px-3.5 py-2.5 align-top text-slate-800 dark:text-zink-100">
                                        {{ $role->name }}
                                    </td>
                                    <td class="px-3.5 py-2.5">
                                        <div class="flex gap-2">
                                            <!-- View -->
                                            <a href="{{ route('admin.roles.show', $role) }}" 
                                               class="flex items-center justify-center size-[30px] p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20"
                                               title="View Details">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="eye" class="lucide lucide-eye size-3">
                                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </a>
                                            <!-- Edit -->
                                            <a href="{{ route('admin.roles.edit', $role) }}" 
                                               class="flex items-center justify-center size-[30px] p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20"
                                               title="Edit Role">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="pencil" class="lucide lucide-pencil size-3">
                                                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"></path>
                                                    <path d="m15 5 4 4"></path>
                                                </svg>
                                            </a>
                                            <!-- Delete -->
                                            <form action="{{ route('admin.roles.delete', $role) }}" 
                                                  method="POST" 
                                                  class="inline-block"
                                                  onsubmit="return confirm('Are you sure you want to delete this role?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="flex items-center justify-center size-[30px] p-0 text-red-500 btn bg-red-100 hover:text-white hover:bg-red-600 focus:text-white focus:bg-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:ring active:ring-red-100 dark:bg-red-500/20 dark:text-red-500 dark:hover:bg-red-500 dark:hover:text-white dark:focus:bg-red-500 dark:focus:text-white dark:active:bg-red-500 dark:active:text-white dark:ring-red-400/20"
                                                        title="Delete Role">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="trash-2" class="lucide lucide-trash-2 size-3">
                                                        <path d="M3 6h18"></path>
                                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                        <path d="M8 6V4c0-1 1-2 2-2h4c0-1 1-2 2-2v2"></path>
                                                        <line x1="10" x2="10" y1="11" y2="17"></line>
                                                        <line x1="14" x2="14" y1="11" y2="17"></line>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-3.5 py-4 text-center text-slate-500 dark:text-zink-200">No roles available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>
