<x-admin-layout>
   
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Employees</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('admin.dashboard') }}" class="text-slate-400 dark:text-zink-200">Home</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">
                    Employees
                </li>
            </ul>
        </div>
        <div class="relative grow">
            <input type="text" id="employee-search" class="mb-4 ltr:pl-8 rtl:pr-8 search form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Search by name or email..." autocomplete="off">
            <i data-lucide="search" class="inline-block size-4 absolute ltr:left-2.5 rtl:right-2.5 top-2.5 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-600"></i>
        </div>
        <form method="GET" action="{{ route('admin.employee.index') }}" class="mb-4 flex gap-4 items-center">
            <select name="department" class="text-slate-800 dark:text-white bg-transparent form-select border border-gray-300 rounded px-2 py-1">
                <option value="" class="text-slate-800 dark:text-black bg-white dark:bg-zinc-700">All Departments</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ request('department') == $department->id ? 'selected' : '' }} class="text-slate-800 dark:text-black bg-white dark:bg-zinc-700">
                        {{ ucfirst($department->name) }}
                    </option>
                @endforeach
            </select>

            <select name="status" class="text-slate-800 dark:text-white bg-transparent form-select border border-gray-300 rounded px-2 py-1">
                <option value="" class="text-slate-800 dark:text-black bg-white dark:bg-zinc-700">All Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }} class="text-slate-800 dark:text-black bg-white dark:bg-zinc-700">Active</option>
                <option value="on leave" {{ request('status') == 'on leave' ? 'selected' : '' }} class="text-slate-800 dark:text-black bg-white dark:bg-zinc-700">On Leave</option>
                <option value="resigned" {{ request('status') == 'resigned' ? 'selected' : '' }} class="text-slate-800 dark:text-black bg-white dark:bg-zinc-700">Resigned</option>
            </select>

           <button type="submit" class="bg-blue-600 text-white px-3 py-1 border border-gray-300 rounded">Filter</button>
        </form>

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
                    <table class="w-full" id="employee-table">
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
                        <tbody id="employee-table-body">
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
                                            <a href="{{ route('admin.employee.show', $employee->id) }}" class="text-blue-500 hover:text-blue-600 mr-2">View</a>
                                            <a href="{{ route('admin.employee.edit', $employee->id) }}" class="text-yellow-600 hover:text-yellow-800 mr-2">Edit</a>
                                            <form action="{{ route('admin.employee.delete', $employee->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this employee?');">
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
                <x-pagination-tailwind :items="$employees" />

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function debounce(func, delay) {
                let timeout;
                return function (...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), delay);
                };
            }

            function searchEmployees() {
                let query = $('#employee-search').val();

                $.ajax({
                    url: "{{ route('admin.employee.search') }}",
                    type: "GET",
                    data: { query: query },
                    success: function (data) {
                        $('#employee-table-body').html(data.html);
                    }
                });
            }

            $('#employee-search').on('keyup', debounce(searchEmployees, 300));
        </script>
</x-admin-layout>