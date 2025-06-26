<x-admin-layout>

    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">EMS</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('admin.payments.index') }}" class="text-slate-400 dark:text-zink-200">Payments</a>
                </li>
                <li>/</li>
                <li class="text-slate-700 dark:text-zink-100">Request #{{ $paymentRequest->id }}</li>
            </ul>
        </div>

        <div class="grid grid-cols-12 gap-x-5">
            <div class="col-span-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-4 text-15">Your Payment Request Details</h6>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-800 dark:text-zink-200">

                            <div>
                                <span class="font-semibold">Payment Type:</span>
                                <p>{{ config('payments.types')[$paymentRequest->payment_type] ?? ucfirst($paymentRequest->payment_type) }}</p>
                            </div>

                            <div>
                                <span class="font-semibold">Amount:</span>
                                <p>₦{{ number_format($paymentRequest->amount, 2) }}</p>
                            </div>

                            <div class="md:col-span-2">
                                <span class="font-semibold">Description:</span>
                                <p class="whitespace-pre-wrap">{{ $paymentRequest->description }}</p>
                            </div>

                            <div>
                                <span class="font-semibold">Status:</span>
                                <p>
                                    <span class="px-2 py-1 rounded-full text-sm font-semibold border
                                        @if($paymentRequest->status === 'approved_by_admin' || $paymentRequest->status === 'approved_by_finance') bg-green-600 text-green-600 border-green-500
                                        @elseif($paymentRequest->status === 'pending') bg-yellow-600 text-yellow-600 border-yellow-500
                                        @elseif($paymentRequest->status === 'denied_by_admin' || $paymentRequest->status === 'denied_by_finance') bg-red-600 text-red-600 border-red-500
                                        @else bg-gray-600 text-gray-800 border-gray-400
                                        @endif">
                                        {{ ucfirst($paymentRequest->status) }}
                                    </span>
                                </p>
                            </div>

                            <div>
                                <span class="font-semibold">Submitted On:</span>
                                <p>{{ \Carbon\Carbon::parse($paymentRequest->created_at)->format('M d, Y h:i A') }}</p>
                            </div>

                        </div>

                        <div class="mt-6 flex gap-3">
                            <a href="{{ route('admin.payments.index') }}" class="btn border border-gray-300 dark:border-zink-400 text-gray-700 dark:text-zink-200 hover:bg-gray-100 dark:hover:bg-zink-700">
                                Back to List
                            </a>

                            @if ($paymentRequest->status === 'pending')
                                <a href="{{ route('admin.payments.edit', $paymentRequest->id) }}" class="btn text-white bg-green-500 hover:bg-green-600">
                                    Edit Request
                                </a>
                                <form method="POST" action="{{ route('admin.payments.destroy', $paymentRequest->id) }}" onsubmit="return confirm('Are you sure you want to delete this request?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn text-white bg-red-500 hover:bg-red-600">
                                        Delete Request
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

</x-admin-layout>
