<x-app-layout>
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Request Stock Item</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('dashboard') }}" class="text-slate-400 dark:text-zink-200">Home</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">Stock Request</li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('stockRequisitions.store') }}" method="POST">
                    @csrf
                    <h6 class="mb-4 text-gray-800 text-16 dark:text-zink-50">Request for Stock</h6>

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

                    <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">

                        <div class="xl:col-span-4">
                            <label for="stock_item_id" class="inline-block mb-2 text-base font-medium">Select Item:</label>
                            <x-select-input id="stock_item_id" name="stock_item_id" required>
                                <option value="">-- Select Item --</option>
                                @foreach ($stockItems as $item)
                                    <option value="{{ $item->id }}" {{ old('stock_item_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }} ({{ $item->category }} )
                                    </option>
                                @endforeach
                            </x-select-input>
                            <x-input-error :messages="$errors->get('stock_item_id')" class="mt-2" />
                        </div>

                        <div class="xl:col-span-4">
                            <label for="quantity" class="inline-block mb-2 text-base font-medium">Quantity:</label>
                            <x-text-input type="number" id="quantity" name="quantity" min="1" value="{{ old('quantity') }}" required />
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>

                        <div class="xl:col-span-4">
                            <label for="note" class="inline-block mb-2 text-base font-medium">Note:</label>
                            <x-text-input type="text" id="note" name="note" value="{{ old('note') }}" placeholder="Reason or details (optional)" />
                            <x-input-error :messages="$errors->get('note')" class="mt-2" />
                        </div>
                    </div><!--end grid-->

                    <div class="flex justify-end gap-2 mt-5">
                        <button type="reset" class="text-slate-500 btn bg-slate-200 border-slate-200 hover:text-slate-600 hover:bg-slate-300 hover:border-slate-300 focus:text-slate-600 focus:bg-slate-300 focus:border-slate-300 focus:ring focus:ring-slate-100 active:text-slate-600 active:bg-slate-300 active:border-slate-300 active:ring active:ring-slate-100 dark:bg-zink-600 dark:hover:bg-zink-500 dark:border-zink-600 dark:hover:border-zink-500 dark:text-zink-200 dark:ring-zink-400/50">Reset</button>
                        <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
