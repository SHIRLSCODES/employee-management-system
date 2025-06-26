<x-admin-layout>
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Create Stock Item</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('admin.dashboard') }}" class="text-slate-400 dark:text-zink-200">Home</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">New Stock</li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.stocks.store') }}" method="POST">
                    @csrf
                    <h6 class="mb-4 text-gray-800 text-16 dark:text-zink-50">Add New Stock Item</h6>

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
                            <label for="name" class="inline-block mb-2 text-base font-medium">Item Name:</label>
                            <x-text-input id="name" name="name" value="{{ old('name') }}" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="xl:col-span-4">
                            <label for="quantity" class="inline-block mb-2 text-base font-medium">Quantity:</label>
                            <x-text-input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}" min="1" required />
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>

                        {{-- <div class="xl:col-span-4">
                            <label for="unit" class="inline-block mb-2 text-base font-medium">Unit (e.g. pcs, packs):</label>
                            <x-text-input id="unit" name="unit" value="{{ old('unit') }}" required />
                            <x-input-error :messages="$errors->get('unit')" class="mt-2" />
                        </div> --}}
                        <div class="xl:col-span-4">
                            <label for="category" class="inline-block mb-2 text-base font-medium">Category:</label>
                            <x-text-input id="category" name="category" value="{{ old('category') }}" placeholder="e.g. Stationery, Tools" required />
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>
                        <div class="xl:col-span-4">
                            <label for="description" class="inline-block mb-2 text-base font-medium">Description:</label>
                            <x-textarea id="description" name="description" rows="3" placeholder="Optional item details"
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" >{{ old('description') }}</x-textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="xl:col-span-4">
                            <label class="inline-flex items-center gap-2 mt-6">
                                <input type="checkbox" name="is_returnable" value="1" class="rounded border-slate-300 text-custom-500 shadow-sm focus:ring focus:ring-custom-200"
                                    {{ old('is_returnable') ? 'checked' : '' }}>
                                <span class="text-base font-medium text-slate-700 dark:text-zink-100">Returnable?</span>
                            </label>
                        </div>

                    </div><!--end grid-->

                    <div class="flex justify-end gap-2 mt-5">
                        <button type="reset" class="text-slate-500 btn bg-slate-200 border-slate-200 hover:text-slate-600 hover:bg-slate-300 hover:border-slate-300 dark:bg-zink-600 dark:hover:bg-zink-500 dark:border-zink-600 dark:hover:border-zink-500 dark:text-zink-200">Reset</button>
                        <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
