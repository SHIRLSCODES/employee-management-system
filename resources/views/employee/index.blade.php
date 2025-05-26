<x-app-layout>
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Employees</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('dashboard') }}" class="text-slate-400 dark:text-zink-200">Home</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">
                    Employees
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-body">
                <h6 class="mb-4 text-15">All Employees</h6>

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
                       setTimeout(function() {
                        document.getElementById('success-message')?.remove();
                        document.getElementById('error-message')?.remove();
                       }, 10000);
                    </script> 

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="ltr:text-left rtl:text-right">      
                            <tr class="bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold uppercase text-gray-600 dark:text-gray-300">
                                <th class="px-4 py-2">Employee No</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Phone</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-2">{{ $employee->employee_no }}</td>
                                    <td class="px-4 py-2">{{ $employee->first_name .' '. $employee->last_name}}</td>
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
                                        <div class="flex items">
                                            <a href="{{ route('employee.show', $employee->id) }}" class="text-blue-500 hover:text-blue-600 mr-2">View</a>
                                            <a href="{{ route('employee.edit', $employee->id) }}" class="text-yellow-600 hover:text-yellow-800 mr-2">Edit</a>
                                            <form action="{{ route('employee.delete', $employee->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4 flex justify-center">
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>