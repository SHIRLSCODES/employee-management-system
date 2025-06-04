<x-admin-layout>


<div class="container mx-auto px-4 mt-4">
    <h1 class="text-2xl font-bold mb-6">Employees in {{ $department->name }} Department</h1>

    @if($employees->isEmpty())
        <p class="text-gray-500">No employees found in this department.</p>
    @else

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($employees as $employee)
                <div class="bg-white dark:bg-zinc-800 shadow rounded-lg p-4 border border-slate-200 dark:border-zinc-600">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $employee->first_name }} {{ $employee->last_name }}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">{{ $employee->email }}</p>

                    <span class="px-2 py-1 rounded-full text-sm font-semibold border
                             @if($employee->status === 'Active') bg-green-600 text-green-600 border-green-500 
                             @elseif($employee->status === 'on leave') bg-yellow-600 text-yellow-600 border-yellow-500 
                             @elseif($employee->status === 'resigned') bg-red-600 text-red-600 border-red-500 
                             @else bg-gray-600 text-gray-800 border-gray-400 
                             @endif">
                        {{ ucfirst($employee->status) }}
                    </span>
                </div>
            @endforeach
        </div>
    @endif
</div>


</x-admin-layout>
