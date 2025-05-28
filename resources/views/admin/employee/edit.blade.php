<x-admin-layout>
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
                    <a href="{{ route('admin.employee.index') }}" class="text-slate-400 dark:text-zink-200">Employees</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">
                    Edit
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.employee.update', $employee->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <h6 class="mb-4 text-gray-800 text-16 dark:text-zink-50">Edit Employee</h6>
                    <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">

                       
                        <div class="xl:col-span-3">
                            <label for="employee_no" class="inline-block mb-2 text-base font-medium">Employee No:</label>
                            <input type="text" id="employee_no" name="employee_no" value="{{ old('employee_no', $employee->employee_no) }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" required>
                        </div>

                        <div class="xl:col-span-3">
                            <label for="first_name" class="inline-block mb-2 text-base font-medium">First Name:</label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $employee->first_name) }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" required>
                        </div>

                        <div class="xl:col-span-3">
                            <label for="last_name" class="inline-block mb-2 text-base font-medium">Last Name:</label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $employee->last_name) }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" required>
                        </div>

                        <div class="xl:col-span-3">
                            <label for="email" class="inline-block mb-2 text-base font-medium">Email:</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $employee->email) }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" required>
                        </div>

                        <div class="xl:col-span-3">
                            <label for="phone_number" class="inline-block mb-2 text-base font-medium">Phone Number:</label>
                            <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $employee->phone_number) }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" required>
                        </div>

                        <div class="xl:col-span-3">
                            <label for="date_of_birth" class="inline-block mb-2 text-base font-medium">DOB:</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $employee->date_of_birth) }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" required>
                        </div>

                        <div class="xl:col-span-3">
                            <label for="nin" class="inline-block mb-2 text-base font-medium">NIN:</label>
                            <input type="text" id="nin" name="nin" value="{{ old('nin', $employee->nin) }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" required>
                        </div>

                        <div class="xl:col-span-3">
                            <label for="gender" class="inline-block mb-2 text-base font-medium">Gender:</label>
                            <input type="text" id="gender" name="gender" value="{{ old('gender', $employee->gender) }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" required>
                        </div>

                        <div class="xl:col-span-3">
                            <label for="address" class="inline-block mb-2 text-base font-medium">Address:</label>
                            <input type="text" id="address" name="address" value="{{ old('address', $employee->address) }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" required>
                        </div>

                        <div class="xl:col-span-3">
                            <label for="department" class="inline-block mb-2 text-base font-medium">Department:</label>
                            <input type="text" id="department" name="department" value="{{ old('department', $employee->department) }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" required>
                        </div>

                        <div class="xl:col-span-3">
                            <label for="designation" class="inline-block mb-2 text-base font-medium">Designation:</label>
                            <input type="text" id="designation" name="designation" value="{{ old('designation', $employee->designation) }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" required>
                        </div>

                        <div class="xl:col-span-3">
                            <label for="status" class="inline-block mb-2 text-base font-medium">Status:</label>
                            <input type="text" id="status" name="status" value="{{ old('status', $employee->status) }}" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" required>
                        </div>

                    </div>

                    <div class="flex justify-end gap-2 mt-5">
                        <a href="{{ route('admin.employee.index') }}" class="btn bg-slate-200 text-slate-600 hover:bg-slate-300 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-zink-500">Cancel</a>
                            <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
