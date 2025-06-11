<x-admin-layout>

    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Admin - Payment Management</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="#!" class="text-slate-400 dark:text-zink-200">Admin</a>
                </li>
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="#!" class="text-slate-400 dark:text-zink-200">Payments</a>
                </li>
            </ul>
        </div>

        <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">

            <div class="col-span-12">
                <div class="relative overflow-hidden card bg-slate-900">
                    <div class="relative card-body">
                        <div class="grid items-center grid-cols-12">
                            <div class="col-span-12 lg:col-span-8 2xl:col-span-7">
                                <h5 class="mb-3 font-normal tracking-wide text-slate-200">
                                    Hi {{ auth()->user()->first_name }} 👨‍💼<br>
                                    <p>Manage employee payment requests</p> <br> 
                                    @if(auth()->user()->department_id == 7)
                                        <p>You have finance department access for final approvals!</p>
                                    @else
                                        <p>Review and approve requests for finance department processing!</p>
                                    @endif
                                </h5>
                            </div>
                            <div class="hidden col-span-12 2xl:col-span-3 lg:col-span-2 lg:col-start-11 2xl:col-start-10 lg:block">
                                <img src="{{ asset('assets/images/employeebg.png') }}" alt="..." class="w-80 h-40 object-cover ltr:2xl:ml-auto rtl:2xl:mr-auto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-4 text-15">All Payment Requests</h6>

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

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="ltr:text-left rtl:text-right">      
                                    <tr class="bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold uppercase text-gray-600 dark:text-gray-300">
                                        <th class="px-4 py-2">Employee</th>
                                        <th class="px-4 py-2">Payment Type</th>
                                        <th class="px-4 py-2">Description</th>
                                        <th class="px-4 py-2">Amount</th>
                                        <th class="px-4 py-2">Status</th>
                                        <th class="px-4 py-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paymentRequests as $payment)
                                        <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td class="px-4 py-2">
                                                {{ $payment->employee->first_name ?? 'N/A' }} {{ $payment->employee->last_name ?? '' }}
                                            </td>
                                            <td class="px-4 py-2">
                                                {{ config('payments.types')[$payment->payment_type] ?? ucfirst($payment->payment_type) }}
                                            </td>
                                            <td class="px-4 py-2">{{ $payment->description }}</td>
                                            <td class="px-4 py-2">₦{{ number_format($payment->amount, 2) }}</td>
                                            <td class="px-4 py-2">
                                                <span class="px-4 py-2 rounded-full text-sm font-semibold border whitespace-nowrap
                                                    @if($payment->status === 'approved_by_finance') bg-green-600 text-green-600 border-green-500
                                                    @elseif($payment->status === 'approved_by_admin') bg-green-600 text-green-600 border-green-500
                                                    @elseif($payment->status === 'pending') bg-yellow-600 text-yellow-600 border-yellow-500
                                                    @elseif($payment->status === 'denied_by_finance') bg-red-600 text-red-600 border-red-500
                                                    @elseif($payment->status === 'denied_by_admin') bg-red-600 text-red-600 border-red-500
                                                    @else bg-gray-600 text-gray-600 border-gray-500
                                                    @endif">
                                                    {{ ucfirst($payment->status) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-2">
                                                <div class="flex items-center gap-2">
                                                    <a href="{{ route('admin.payments.show', $payment->id) }}" class="text-blue-500 hover:text-blue-600">View</a>

                                                    @if(auth()->user()->department_id != 7 && $payment->admin_id != auth()->id() && $payment->status === 'pending')
                                                        <form action="{{ route('admin.payments.approve', $payment->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="text-green-600 hover:text-green-800 font-medium" onclick="return confirm('Are you sure you want to approve this payment request?')">
                                                                Approve
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.payments.deny', $payment->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Are you sure you want to deny this payment request?')">
                                                                Deny
                                                            </button>
                                                        </form>
                                                    @endif

                                                    @if(auth()->user()->department_id == 7 && $payment->status === 'approved_by_admin')
                                                        <form action="{{ route('admin.payments.approve.finance', $payment->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="text-green-600 hover:text-green-600 font-medium bg-transparent px-2 py-1 rounded" onclick="return confirm('Are you sure you want to approve this payment request for finance?')">
                                                                Finance Approve
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.payments.deny.finance', $payment->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="text-red-600 hover:text-red-600 font-medium bg-transparent px-2 py-1 rounded" onclick="return confirm('Are you sure you want to deny this payment request?')">
                                                                Finance Deny
                                                            </button>
                                                        </form>
                                                    @endif

                                                    @if($payment->admin_id == auth()->id())
                                                        <span class="text-gray-500 text-sm italic">(Your Request)</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <x-pagination-tailwind :items="$paymentRequests" />
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</x-admin-layout>