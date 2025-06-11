<x-app-layout>

    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">EMS</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
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
                                    Hi {{ auth()->user()->first_name }} 💸<br>
                                    <p>Need reimbursement or advance payment?</p> <br> 
                                    <p>Submit a request and let finance handle the rest!</p>
                                </h5> 
                                <form method="GET" action="{{ route('payments.create') }}"> 
                                    <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-500/20 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-500/20 dark:ring-custom-400/20">Create Payment Request</button>
                                </form> 
                            </div>
                            <div class="hidden col-span-12 2xl:col-span-3 lg:col-span-2 lg:col-start-11 2xl:col-start-10 lg:block">
                                <img src="assets/images/employeebg.png" alt="..." class="w-80 h-40 object-cover ltr:2xl:ml-auto rtl:2xl:mr-auto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-4 text-15">Your Payment Requests</h6>

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
                                                {{ config('payments.types')[$payment->payment_type] ?? ucfirst($payment->payment_type) }}
                                            </td>
                                            <td class="px-4 py-2">{{ $payment->description }}</td>
                                            <td class="px-4 py-2">₦{{ number_format($payment->amount, 2) }}</td>
                                            <td class="px-4 py-2">
                                                <span class="px-2 py-1 rounded-full text-sm font-semibold border
                                                    @if($payment->status === 'approved_by_finance' || $payment->status === 'approved_by_admin') bg-green-600 text-green-600 border-green-500 
                                                    @elseif($payment->status === 'pending') bg-yellow-600 text-yellow-600 border-yellow-500 
                                                    @elseif($payment->status === 'denied_by_finance' || $payment->status === 'denied_by_admin') bg-red-600 text-red-600 border-red-500 
                                                    @else bg-gray-600 text-gray-800 border-gray-400 
                                                    @endif">
                                                    {{ ucfirst($payment->status) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-2">
                                                <div class="flex items-center">
                                                    <a href="{{ route('payments.show', $payment->id) }}" class="text-blue-500 hover:text-blue-600 mr-2">View</a>

                                                    @if ($payment->status === 'pending')
                                                        <a href="{{ route('payments.edit', $payment->id) }}" class="text-yellow-600 hover:text-yellow-800 mr-2">Edit</a>
                                                        <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this payment request?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                                        </form>
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

</x-app-layout>
