<x-admin-layout>
   
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Departments</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('admin.dashboard') }}" class="text-slate-400 dark:text-zink-200">Home</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">
                    Departments
                </li>
            </ul>
        </div>
        <div class="relative grow">
            <input type="text" id="department-search" class="mb-4 ltr:pl-8 rtl:pr-8 search form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Search by name or email..." autocomplete="off">
            <i data-lucide="search" class="inline-block size-4 absolute ltr:left-2.5 rtl:right-2.5 top-2.5 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-600"></i>
        </div>
        <div class="card">
            <div class="card-body">
                <h6 class="mb-4 text-15">All Departments</h6>
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
                        <thead class="ltr:text-left rtl:text-right ">
                            <tr>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Name</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Code</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Description</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Status</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments as $department)
                                <tr class="even:bg-slate-50 hover:bg-slate-50 even:hover:bg-slate-100 dark:even:bg-zink-600/50 dark:hover:bg-zink-600 dark:even:hover:bg-zink-600">
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $department->name }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $department->code }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $department->description }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">  
                                        <span class="px-2 py-1 rounded-full text-sm font-semibold border
                                                @if($department->status === 'active') bg-green-600 text-green-600 border-green-500 
                                                @elseif($department->status === 'inactive') bg-yellow-600 text-yellow-600 border-yellow-500 
                                                @else bg-gray-600 text-gray-800 border-gray-400 
                                                @endif
                                            ">
                                                {{ ucfirst($department->status) }}
                                            </span>
                                    </td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                        <div class="flex items">
                                            <a href="{{ route('admin.departments.show', $department->id) }}" class="text-blue-500 hover:text-blue-600 mr-2">View</a>
                                            <a href="{{ route('admin.departments.edit', $department->id) }}" class="text-yellow-600 hover:text-yellow-800 mr-2">Edit</a>
                                            <form action="{{ route('admin.departments.destroy', $department->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this department?');">
                                                @csrf
                                                <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <x-pagination-tailwind :items="$departments" />
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

            function searchDepartments() {
                let query = $('#department-search').val();

                $.ajax({
                    url: "{{ route('admin.departments.index') }}",
                    type: "GET",
                    data: { query: query },
                    success: function (data) {
                        $('#department-table-body').html(data.html);
                    }
                });
            }

            $('#department-search').on('keyup', debounce(searchDepartments, 300));
        </script>
</x-admin-layout>