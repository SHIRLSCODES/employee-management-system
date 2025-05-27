    @foreach ($employees as $employee)
        <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
            <td class="px-4 py-2">{{ $employee->employee_no }}</td>
            <td class="px-4 py-2">{{ $employee->first_name . ' ' . $employee->last_name }}</td>
            <td class="px-4 py-2">{{ $employee->email }}</td>
            <td class="px-4 py-2">{{ $employee->phone_number }}</td>
            <td class="px-4 py-2">
                <span class="px-2 py-1 rounded-full text-sm font-semibold border
                    @if($employee->status === 'Active') bg-green-600 text-green-600 border-green-500 
                    @elseif($employee->status === 'on leave') bg-yellow-600 text-yellow-600 border-yellow-500 
                    @elseif($employee->status === 'resigned') bg-red-600 text-red-600 border-red-500 
                    @else bg-gray-600 text-gray-800 border-gray-400 
                    @endif
                ">
                    {{ ucfirst($employee->status) }}
                </span>
            </td>
            <td class="px-4 py-2">
                <div class="flex items-center">
                    <a href="{{ route('employee.show', $employee->id) }}" class="text-blue-500 hover:text-gray-800 mr-2">View</a>
                    <a href="{{ route('employee.edit', $employee->id) }}" class="text-yellow-600 hover:text-yellow-800 mr-2">Edit</a>
                    <form action="{{ route('employee.delete', $employee->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this employee?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                    </form>
                </div>
            </td>
        </tr>    
    @endforeach