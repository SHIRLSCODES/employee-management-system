<x-admin-layout>
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Admin Check-In</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('dashboard') }}" class="text-slate-400 dark:text-zink-200">Home</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">
                    Check-In
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <h6 class="mb-4 text-gray-800 text-16 dark:text-zink-50">Daily Check-In</h6>

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

                <form action="{{ route('admin.attendance.create') }}" method="POST">
                    @csrf
                    <div class="flex flex-col gap-4 xl:flex-row xl:items-center">
                        <div class="xl:grow">
                            <label class="inline-block mb-2 text-base font-medium">Current Date:</label>
                            <x-text-input type="text" name="attendance_date" value="{{ now()->toDateString() }}" readonly class="w-full" />
                        </div>
                       <div class="xl:grow">
                            <label for="branch" class="inline-block mb-2 text-base font-medium">Branch:</label>
                            <x-select-input id="branch" name="branch" required>
                                <option selected disabled>-- Select Branch --</option>
                                <option value="EMS Island" {{ old('branch') == 'EMS Island' ? 'selected' : '' }}>EMS Island</option>
                                <option value="EMS Mainland" {{ old('branch') == 'EMS Mainland' ? 'selected' : '' }}>EMS Mainland</option>
                            </x-select-input>
                            <x-input-error :messages="$errors->get('branch')" class="mt-2" />
                        </div>

                       
                        <div class="flex justify-end gap-2 mt-5">
                            <button type="reset" class="text-slate-500 btn bg-slate-200 border-slate-200 hover:text-slate-600 hover:bg-slate-300 hover:border-slate-300 focus:text-slate-600 focus:bg-slate-300 focus:border-slate-300 focus:ring focus:ring-slate-100 active:text-slate-600 active:bg-slate-300 active:border-slate-300 active:ring active:ring-slate-100 dark:bg-zink-600 dark:hover:bg-zink-500 dark:border-zink-600 dark:hover:border-zink-500 dark:text-zink-200 dark:ring-zink-400/50"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="refresh-ccw" class="lucide lucide-refresh-ccw inline-block mr-1 size-4"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path><path d="M3 3v5h5"></path><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"></path><path d="M16 16h5v5"></path></svg> <span class="align-middle">Reset</span></button>
                            <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="alarm clock" class="lucide lucide-save inline-block mr-1 size-4"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> <span class="align-middle">Check In</span></button>
                        </div>
                    
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>

