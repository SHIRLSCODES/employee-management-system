<x-app-layout>
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Edit Stock Return</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('dashboard') }}" class="text-slate-400 dark:text-zink-200">Home</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">Edit Return</li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('stockReturns.update', $stockReturn->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <h6 class="mb-4 text-gray-800 text-16 dark:text-zink-50">Update Stock Return</h6>

                    <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                        <div class="xl:col-span-4">
                            <label for="stock_item_id" class="inline-block mb-2 text-base font-medium">Select Item:</label>
                            <x-select-input id="stock_item_id" name="stock_item_id" required>
                                <option value="">-- Select Item --</option>
                                @foreach ($stockItems as $item)
                                    <option value="{{ $item->id }}" {{ old('stock_item_id', $stockReturn->stock_item_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }} ({{ $item->category }})
                                    </option>
                                @endforeach
                            </x-select-input>
                            <x-input-error :messages="$errors->get('stock_item_id')" class="mt-2" />
                        </div>

                        <div class="xl:col-span-4">
                            <label for="stock_requisition_id" class="inline-block mb-2 text-base font-medium">Linked Requisition (Optional):</label>
                            <x-select-input id="stock_requisition_id" name="stock_requisition_id">
                                <option value="">-- None --</option>
                                @foreach ($stockRequisitions as $req)
                                    <option value="{{ $req->id }}" {{ old('stock_requisition_id', $stockReturn->stock_requisition_id) == $req->id ? 'selected' : '' }}>
                                        Requisition #{{ $req->id }} - {{ $req->stockItem->name }}
                                    </option>
                                @endforeach
                            </x-select-input>
                            <x-input-error :messages="$errors->get('stock_requisition_id')" class="mt-2" />
                        </div>

                        <div class="xl:col-span-4">
                            <label for="quantity" class="inline-block mb-2 text-base font-medium">Quantity:</label>
                            <x-text-input type="number" id="quantity" name="quantity" min="1" value="{{ old('quantity', $stockReturn->quantity) }}" required />
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>

                        <div class="xl:col-span-4">
                            <label for="condition" class="inline-block mb-2 text-base font-medium">Condition:</label>
                            <x-select-input id="condition" name="condition" required>
                                <option value="">-- Select Condition --</option>
                                @foreach(['good', 'damaged', 'unused'] as $cond)
                                    <option value="{{ $cond }}" {{ old('condition', $stockReturn->condition) === $cond ? 'selected' : '' }}>
                                        {{ ucfirst($cond) }}
                                    </option>
                                @endforeach
                            </x-select-input>
                            <x-input-error :messages="$errors->get('condition')" class="mt-2" />
                        </div>

                        <div class="xl:col-span-8">
                            <label for="remarks" class="inline-block mb-2 text-base font-medium">Remarks:</label>
                            <textarea id="remarks" name="remarks" rows="3" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:focus:border-custom-800 dark:bg-zink-700 dark:text-zink-100 placeholder:text-slate-400 dark:placeholder:text-zink-200">{{ old('remarks', $stockReturn->remarks) }}</textarea>
                            <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-5">
                        <a href="{{ route('stockReturns.index') }}" class="text-white btn bg-slate-500 border-slate-500 hover:bg-slate-600 hover:border-slate-600">
                            Cancel
                        </a>
                        <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 border-custom-600">
                            Update Return
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
