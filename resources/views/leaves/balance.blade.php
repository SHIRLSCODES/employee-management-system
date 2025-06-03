<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="bg-transparent border border-gray-300 dark:border-gray-600 rounded-lg shadow-md p-6 max-w-md mx-auto">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Below is your Leave Balance details</h2>

            <div class="space-y-3 text-gray-700 dark:text-gray-300">
                <p>
                    <strong class="text-gray-900 dark:text-white">Total Leave Days Available:</strong>
                    {{ $employee->total_leave_days }}
                </p>
                <p>
                    <strong class="text-gray-900 dark:text-white">Used Leave Days:</strong>
                    {{ $employee->usedLeaveDays() }}
                </p>
                <p>
                    <strong class="text-gray-900 dark:text-white">Leave Balance:</strong>
                    @if($employee->leaveBalance() == 0)
                        You have no leave days remaining for this year, stay in your office. We love you!
                    @else
                        {{ $employee->leaveBalance() }}
                    @endif
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
