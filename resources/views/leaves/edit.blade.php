<x-app-layout>
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Edit your Leave Request</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('dashboard') }}" class="text-slate-400 dark:text-zink-200">Home</a>
                </li>
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('leaves.index') }}" class="text-slate-400 dark:text-zink-200">Leaves</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">
                    Edit
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('leaves.update', $leave->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <h6 class="mb-4 text-gray-800 text-16 dark:text-zink-50">Edit your leave request</h6>
                    <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                        <div class="xl:col-span-3">
                            <label for="leave_type" class="inline-block mb-2 text-base font-medium">Leave Type:</label>
                            <x-select-input id="leave_type" name="leave_type" required>
                                <option selected disabled>-- Select Leave Type --</option>
                                <option value="sick" {{ old('leave_type', $leave->leave_type) == 'sick' ? 'selected' : '' }}>Sick</option>
                                <option value="vacation" {{ old('leave_type', $leave->leave_type) == 'vacation' ? 'selected' : '' }}>Vacation</option>
                                <option value="personal" {{ old('leave_type', $leave->leave_type) == 'personal' ? 'selected' : '' }}>Personal</option>
                            </x-select-input>
                            <x-input-error :messages="$errors->get('leave_type')" class="mt-2" />
                        </div>

                        <div class="xl:col-span-3">
                            <label for="start_date" class="inline-block mb-2 text-base font-medium">Start Date:</label>
                            <x-text-input type="date" id="start_date" name="start_date" value="{{ old('start_date', $leave->start_date) }}" required />
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>

                        <div class="xl:col-span-3">
                            <label for="end_date" class="inline-block mb-2 text-base font-medium">End Date:</label>
                            <x-text-input type="date" id="end_date" name="end_date" value="{{ old('end_date', $leave->end_date) }}" required />
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>

                        <div class="xl:col-span-3">
                            <label for="number_of_days" class="inline-block mb-2 text-base font-medium">Number of Days:</label>
                            <x-text-input type="number" id="number_of_days" name="number_of_days" value="{{ old('number_of_days', $leave->number_of_days) }}" required min="1" />
                            <x-input-error :messages="$errors->get('number_of_days')" class="mt-2" />
                        </div>

                        <div class="xl:col-span-3">
                            <label for="reason" class="inline-block mb-2 text-base font-medium">Reason:</label>
                            <textarea id="reason" name="reason" rows="4" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" required>{{ old('reason', $leave->reason) }}</textarea>
                            <x-input-error :messages="$errors->get('reason')" class="mt-2" />
                        </div>
                    </div><!--end grid-->

                    <div class="flex justify-end gap-2 mt-5">
                        <button type="reset" class="text-slate-500 btn bg-slate-200 border-slate-200 hover:text-slate-600 hover:bg-slate-300 hover:border-slate-300 focus:text-slate-600 focus:bg-slate-300 focus:border-slate-300 focus:ring focus:ring-slate-100 active:text-slate-600 active:bg-slate-300 active:border-slate-300 active:ring active:ring-slate-100 dark:bg-zink-600 dark:hover:bg-zink-500 dark:border-zink-600 dark:hover:border-zink-500 dark:text-zink-200 dark:ring-zink-400/50"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="refresh-ccw" class="lucide lucide-refresh-ccw inline-block mr-1 size-4"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path><path d="M3 3v5h5"></path><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"></path><path d="M16 16h5v5"></path></svg> <span class="align-middle">Reset</span></button>
                        <a href="{{ route('leaves.index') }}" class="text-white btn bg-slate-500 border-slate-500 hover:bg-slate-600 hover:border-slate-600">
                        Back to List
                        </a>
                        <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="save" class="lucide lucide-save inline-block mr-1 size-4"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> <span class="align-middle">Update</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>