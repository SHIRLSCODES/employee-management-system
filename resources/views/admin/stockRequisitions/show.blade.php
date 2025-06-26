<x-admin-layout>
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Stock Requisition Details</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('admin.dashboard') }}" class="text-slate-400 dark:text-zink-200">Home</a>
                </li>
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('admin.stockRequisitions.index') }}" class="text-slate-400 dark:text-zink-200">Stock Requisitions</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">View</li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <h6 class="mb-4 text-gray-800 text-16 dark:text-zink-50">Requisition Information</h6>

                <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                    <div class="xl:col-span-4">
                        <label class="block mb-1 font-medium">Stock Item:</label>
                        <p class="text-gray-700 dark:text-zink-100">{{ $stockRequisition->stockItem->name ?? 'N/A' }}</p>
                    </div>

                    <div class="xl:col-span-4">
                        <label class="block mb-1 font-medium">Category:</label>
                        <p class="text-gray-700 dark:text-zink-100">{{ $stockRequisition->stockItem->category ?? '-' }}</p>
                    </div>

                    <div class="xl:col-span-4">
                        <label class="block mb-1 font-medium">Requested Quantity:</label>
                        <p class="text-gray-700 dark:text-zink-100">{{ $stockRequisition->quantity }} {{ $stockRequisition->stockItem->unit ?? '' }}</p>
                    </div>

                    <div class="xl:col-span-4">
                        <label class="block mb-1 font-medium">Status:</label>
                        <span class="px-2 py-1 rounded-full text-sm font-semibold border
                            @if($stockRequisition->status === 'approved') bg-green-600 text-white border-green-500 
                            @elseif($stockRequisition->status === 'pending') bg-yellow-600 text-white border-yellow-500 
                            @elseif($stockRequisition->status === 'denied') bg-red-600 text-white border-red-500 
                            @else bg-gray-600 text-white border-gray-400 
                            @endif">
                            {{ ucfirst($stockRequisition->status) }}
                        </span>
                    </div>

                    <div class="xl:col-span-12">
                        <label class="block mb-1 font-medium">Note:</label>
                        <p class="text-gray-700 dark:text-zink-100">{{ $stockRequisition->note ?? 'No additional note provided.' }}</p>
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-5">
                    <a href="{{ route('admin.stockRequisitions.adminIndex') }}" class="text-white btn bg-slate-500 border-slate-500 hover:bg-slate-600 hover:border-slate-600">
                        Back to List
                    </a>
                    @if($stockRequisition->status === 'pending')
                        <a href="{{ route('admin.stockRequisitions.edit', $stockRequisition->id) }}" class="text-white btn bg-blue-500 border-blue-500 hover:bg-blue-600 hover:border-blue-600">
                            Edit Requisition
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
