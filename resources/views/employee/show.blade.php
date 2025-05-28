<x-app-layout>
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
    
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-xl font-semibold text-gray-800 dark:text-white">Employee Profile</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0 text-gray-500 dark:text-zinc-300">
                <li>
                    <a href="{{ route('dashboard') }}" class="hover:underline">Home</a>
                </li>
                <li>/</li>
                <li>Employee Profile</li>
            </ul>
        </div>

        <div class="card bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h6 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Personal Information</h6>

            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm md:text-base">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 mb-1">Employee Number</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ $employee->employee_no }}</p>
                </div>
                <div>
                    <p class="text-gray-500 dark:text-gray-400 mb-1">Full Name</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ $employee->first_name }} {{ $employee->last_name }}</p>
                </div>
                <div>
                    <p class="text-gray-500 dark:text-gray-400 mb-1">Email</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ $employee->email }}</p>
                </div>
                <div>
                    <p class="text-gray-500 dark:text-gray-400 mb-1">Phone Number</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ $employee->phone_number }}</p>
                </div>
                <div>
                    <p class="text-gray-500 dark:text-gray-400 mb-1">NIN</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ $employee->nin }}</p>
                </div>
                <div>
                    <p class="text-gray-500 dark:text-gray-400 mb-1">Gender</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ $employee->gender }}</p>
                </div>
                <div>
                    <p class="text-gray-500 dark:text-gray-400 mb-1">Date of Birth</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($employee->date_of_birth)->format('F d, Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-500 dark:text-gray-400 mb-1">Department</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ $employee->department->name }}</p>
                </div>
                <div>
                    <p class="text-gray-500 dark:text-gray-400 mb-1">Designation</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ $employee->designation }}</p>
                </div>
                <div>
                    <p class="text-gray-500 dark:text-gray-400 mb-1">Status</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ $employee->status }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-gray-500 dark:text-gray-400 mb-1">Address</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ $employee->address }}</p>
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-8">
                <a href="{{ route('dashboard') }}" class="inline-block bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-semibold py-2 px-6 rounded-lg transition">
                    ← Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
