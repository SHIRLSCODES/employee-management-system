<x-admin-layout>
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">All Stock Requisitions</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('admin.dashboard') }}" class="text-slate-400 dark:text-zink-200">Dashboard</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">All Requisitions</li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <h6 class="text-gray-800 text-16 mb-6 dark:text-zink-50">Requisition Management</h6>

               @if (session('success'))
                        <div id="success-message" class="mb-4 p-4 bg-green-500 text-white rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div id="error-message" class="mb-4 p-3 bg-red-500 text-white rounded-md">
                            {{ session('error') }}
                        </div>
                    @endif

                    <script>
                        setTimeout(function () {
                            document.getElementById('success-message')?.remove();
                            document.getElementById('error-message')?.remove();
                        }, 10000);
                    </script>

                @if($requisitions->count())
                    <div class="overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <thead class="bg-slate-100 text-slate-500 dark:bg-zink-600 dark:text-zink-200">
                                <tr>
                                    <th class="px-4 py-2 border-b">ID</th>
                                    <th class="px-4 py-2 border-b">Employee/Admin</th>
                                    <th class="px-4 py-2 border-b">Stock Item</th>
                                    <th class="px-4 py-2 border-b">Category</th>
                                    <th class="px-4 py-2 border-b">Quantity</th>
                                    <th class="px-4 py-2 border-b">Status</th>
                                    <th class="px-4 py-2 border-b">Requested</th>
                                    <th class="px-4 py-2 border-b">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($requisitions as $requisition)
                                    <tr class="border-b dark:border-zink-500">
                                        <td class="px-4 py-2">#{{ $requisition->id }}</td>
                                        <td class="px-4 py-2">
                                            {{ $requisition->display_name }}
                                            <span class="text-xs text-gray-500 block">
                                                ID: {{ $requisition->requestable->id ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2">{{ $requisition->stockItem->name }}</td>
                                        <td class="px-4 py-2">{{ $requisition->stockItem->category }}</td>
                                        <td class="px-4 py-2">
                                            {{ number_format($requisition->quantity) }}
                                            {{ $requisition->stockItem->unit }}
                                        </td>
                                        <td class="px-4 py-2 capitalize">{{ $requisition->status }}</td>
                                        <td class="px-4 py-2">{{ $requisition->created_at->format('M d, Y H:i') }}</td>
                                        <td class="px-4 py-2">
                                            <div class="flex gap-2">
                                                <a href="{{ route('admin.stockRequisitions.show', $requisition) }}"
                                                   class="btn bg-transparent text-blue-500 hover:text-blue-600 ml-2">View</a>

                                                @if($requisition->status === 'pending')
                                                    <form action="{{ route('admin.stockRequisitions.approve', $requisition) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn bg-transparent text-green-600 hover:bg-green-300">
                                                            Approve
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.stockRequisitions.deny', $requisition) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn bg-transparent text-red-600 hover:bg-green-400">
                                                            Deny
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <x-pagination-tailwind :items="$requisitions" />
                    </div>

                @else
                    <div class="text-center py-10 text-slate-500 dark:text-zink-300">No requisitions found.</div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
