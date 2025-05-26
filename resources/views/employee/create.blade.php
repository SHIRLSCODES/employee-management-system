<x-app-layout>
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Employees</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('dashboard') }}" class="text-slate-400 dark:text-zink-200">Home</a>
                </li>
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('employee.index') }}" class="text-slate-400 dark:text-zink-200">Employees</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">
                    Create
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('employee.store') }}" method="POST">
                    @csrf
                    <h6 class="mb-4 text-gray-800 text-16 dark:text-zink-50">Add New Employee</h6>
                    <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                         <div class="xl:col-span-3">
                            <label for="employee_no" class="inline-block mb-2 text-base font-medium">Employee No:</label>
                            <input type="text" id="first_name" name="employee_no" value="{{ old('employee_no') }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="" required>
                        </div>
                        <div class="xl:col-span-3">
                            <label for="first_name" class="inline-block mb-2 text-base font-medium">First Name:</label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="E.g: Shirls" required>
                        </div><!--end col-->
                        <div class="xl:col-span-3">
                            <label for="last_name" class="inline-block mb-2 text-base font-medium">Last Name:</label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="E.g: Writes" required>
                        </div><!--end col-->
                        <div class="xl:col-span-3">
                            <label for="email" class="inline-block mb-2 text-base font-medium">Email:</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="***@***.com" required>
                        </div><!--end col-->
                        <div class="xl:col-span-3">
                            <label for="phone_number" class="inline-block mb-2 text-base font-medium">Phone Number:</label>
                            <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="070***" required>
                        </div><!--end col-->
                         <div class="xl:col-span-3">
                            <label for="date_of_birth" class="inline-block mb-2 text-base font-medium">DOB:</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="" required>
                        </div><!--end col-->
                        <div class="xl:col-span-3">
                            <label for="nin" class="inline-block mb-2 text-base font-medium">NIN:</label>
                            <input type="text" id="nin" name="nin" value="{{ old('nin') }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="" required>
                        </div>
                         <div class="xl:col-span-3">
                            <label for="gender" class="inline-block mb-2 text-base font-medium">Gender:</label>
                            <input type="text" id="gender" name="gender" value="{{ old('gender') }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Female/Male" required>
                        </div>
                         <div class="xl:col-span-3">
                            <label for="address" class="inline-block mb-2 text-base font-medium">Address:</label>
                            <input type="text" id="address" name="address" value="{{ old('address') }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="" required>
                        </div>
                         <div class="xl:col-span-3">
                            <label for="department" class="inline-block mb-2 text-base font-medium">Department:</label>
                            <input type="text" id="department" name="department" value="{{ old('department') }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="" required>
                        </div>
                         <div class="xl:col-span-3">
                            <label for="designation" class="inline-block mb-2 text-base font-medium">Designation:</label>
                            <input type="text" id="designation" name="designation" value="{{ old('designation') }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="" required>
                        </div>
                         <div class="xl:col-span-3">
                            <label for="status" class="inline-block mb-2 text-base font-medium">Status:</label>
                            <input type="text" id="status" name="status" value="{{ old('status') }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Active/on leave/resigned" required>
                        </div>
                    </div><!--end grid-->

                    <div class="flex justify-end gap-2 mt-5">
                        <button type="reset" class="text-slate-500 btn bg-slate-200 border-slate-200 hover:text-slate-600 hover:bg-slate-300 hover:border-slate-300 focus:text-slate-600 focus:bg-slate-300 focus:border-slate-300 focus:ring focus:ring-slate-100 active:text-slate-600 active:bg-slate-300 active:border-slate-300 active:ring active:ring-slate-100 dark:bg-zink-600 dark:hover:bg-zink-500 dark:border-zink-600 dark:hover:border-zink-500 dark:text-zink-200 dark:ring-zink-400/50"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="refresh-ccw" class="lucide lucide-refresh-ccw inline-block mr-1 size-4"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path><path d="M3 3v5h5"></path><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"></path><path d="M16 16h5v5"></path></svg> <span class="align-middle">Reset</span></button>
                        <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="save" class="lucide lucide-save inline-block mr-1 size-4"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> <span class="align-middle">Create</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>