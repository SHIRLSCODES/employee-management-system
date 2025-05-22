<x-layouts.app :title="__('Employees')">
     <div class="mb-6 flex items-center justify-between gap-4">
        <flux:heading level="1" class="text-2xl font-bold text-zinc-900 dark:text-white">
            {{ __('Employees') }}
        </flux:heading>

        <a href="{{ route('employee.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700">
            <x-icon name="plus" class="h-4 w-4" />
            {{ __('Add Employee') }}
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white dark:bg-zinc-800 shadow rounded-lg">
        <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
            <thead class="bg-zinc-100 dark:bg-zinc-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-zinc-500 dark:text-zinc-300">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-zinc-500 dark:text-zinc-300">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-zinc-500 dark:text-zinc-300">Position</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-zinc-500 dark:text-zinc-300">Department</th>
                    <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-zinc-500 dark:text-zinc-300">Actions</th>
                </tr>
            </thead>
            {{-- <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                @forelse($employees as $employee)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-zinc-900 dark:text-zinc-100">{{ $employee->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-zinc-900 dark:text-zinc-100">{{ $employee->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-zinc-900 dark:text-zinc-100">{{ $employee->position }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-zinc-900 dark:text-zinc-100">{{ $employee->department }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                        <a href="{{ route('employee.show', $employee) }}" class="text-blue-600 hover:underline">View</a>
                        <a href="{{ route('employee.edit', $employee) }}" class="text-yellow-500 hover:underline">Edit</a>
                        <form action="{{ route('employee.destroy', $employee) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-zinc-500 dark:text-zinc-300">No employees found.</td>
                </tr>
                @endforelse
            </tbody> --}}
        </table>
    </div>
</div> 
</x-layouts.app>


