<x-app-layout>
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Edit Stock Requisition</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('dashboard') }}" class="text-slate-400 dark:text-zink-200">Home</a>
                </li>
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('stockRequisitions.index') }}" class="text-slate-400 dark:text-zink-200">Stock Requisitions</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">Edit</li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('stockRequisitions.update', $stockRequisition->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <h6 class="mb-4 text-gray-800 text-16 dark:text-zink-50">Edit your stock requisition</h6>

                    <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                        <div class="xl:col-span-4">
                            <label for="stock_item_id" class="inline-block mb-2 text-base font-medium">Stock Item:</label>
                            <x-select-input id="stock_item_id" name="stock_item_id" required>
                                <option disabled>-- Select Stock Item --</option>
                                @foreach ($stockItems as $item)
                                    <option value="{{ $item->id }}" {{ old('stock_item_id', $stockRequisition->stock_item_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }} ({{ $item->category }})
                                    </option>
                                @endforeach
                            </x-select-input>
                            <x-input-error :messages="$errors->get('stock_item_id')" class="mt-2" />
                        </div>

                        <div class="xl:col-span-4">
                            <label for="quantity" class="inline-block mb-2 text-base font-medium">Quantity:</label>
                            <x-text-input type="number" step="0.01" id="quantity" name="quantity"
                                          value="{{ old('quantity', $stockRequisition->quantity) }}" required />
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>

                        <div class="xl:col-span-4">
                            <label for="note" class="inline-block mb-2 text-base font-medium">Note:</label>
                            <textarea id="note" name="note" rows="4"
                                      class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:focus:border-custom-800 dark:bg-zink-700 dark:text-zink-100 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                      required>{{ old('note', $stockRequisition->note) }}</textarea>
                            <x-input-error :messages="$errors->get('note')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-5">
                        <button type="reset" class="text-slate-500 btn bg-slate-200 border-slate-200 hover:text-slate-600 hover:bg-slate-300 hover:border-slate-300 dark:bg-zink-600 dark:hover:bg-zink-500 dark:text-zink-200">
                            <svg class="lucide lucide-refresh-ccw inline-block mr-1 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path>
                                <path d="M3 3v5h5"></path>
                                <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"></path>
                                <path d="M16 16h5v5"></path>
                            </svg>
                            <span class="align-middle">Reset</span>
                        </button>

                        <a href="{{ route('stockRequisitions.index') }}" class="text-white btn bg-slate-500 border-slate-500 hover:bg-slate-600 hover:border-slate-600">
                            Back to List
                        </a>

                        <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:ring focus:ring-custom-100">
                            <svg class="lucide lucide-save inline-block mr-1 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                            <span class="align-middle">Update</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
