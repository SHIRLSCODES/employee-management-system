<x-admin-layout>

    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Admin - Leave Management</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="#!" class="text-slate-400 dark:text-zink-200">Admin Dashboard / Leave Requests</a>
                </li>
            </ul>
        </div>

        <div class="col-span-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-4 text-15">All Employee Leave Requests</h6>

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

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="ltr:text-left rtl:text-right">      
                                <tr class="bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold uppercase text-gray-600 dark:text-gray-300">
                                    <th class="px-4 py-2">Employee</th>
                                    <th class="px-4 py-2">Leave Type</th>
                                    <th class="px-4 py-2">Reason</th>
                                    <th class="px-4 py-2">From - Till</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaveRequests as $leaveRequest)
                                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="px-4 py-2">{{ $leaveRequest->employee->first_name }} {{ $leaveRequest->employee->last_name }}</td>
                                        <td class="px-4 py-2">{{ $leaveRequest->leave_type }}</td>
                                        <td class="px-4 py-2">{{ $leaveRequest->reason }}</td>
                                        <td class="px-4 py-2">
                                            {{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('M d, Y') }} - 
                                            {{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('M d, Y') }}
                                        </td>
                                        <td class="px-4 py-2">
                                            <span class="px-2 py-1 rounded-full text-sm font-semibold border
                                                @if($leaveRequest->status === 'approved') bg-green-600 text-green-600 border-green-500 
                                                @elseif($leaveRequest->status === 'pending') bg-yellow-600 text-yellow-600 border-yellow-500 
                                                @elseif($leaveRequest->status === 'denied') bg-red-600 text-red-600 border-red-500 
                                                @else bg-gray-600 text-gray-800 border-gray-400 
                                                @endif">
                                                {{ ucfirst($leaveRequest->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2">
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('admin.leaves.show', $leaveRequest->id) }}" class="text-blue-500 hover:text-blue-600">View</a>

                                                @if ($leaveRequest->status === 'pending')
                                                    <form action="{{ route('admin.leaves.approve', $leaveRequest->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="text-green-600 hover:text-green-800">Approve</button>
                                                    </form>

                                                    <form action="{{ route('admin.leaves.deny', $leaveRequest->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="text-red-600 hover:text-red-800">Deny</button>
                                                    </form>
                                                @else
                                                    <span class="text-gray-400">No actions</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <x-pagination-tailwind :items="$leaveRequests" />
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-admin-layout>
