<x-admin-layout>
    <div class="container mx-auto py-8 bg-transparent">
        <div class="p-6 rounded-xl">

            <h1 class="text-3xl font-bold text-gray-700 dark:text-gray-300 mb-6">Leave Days Setup</h1>

                    @if (session('success'))
                        <div id="success-message" class="mb-4 p-4 bg-green-500 text-white rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div id="error-message" class="mb-4 p-3 bg-red-600 text-white rounded-md">
                            {{ session('error') }}
                        </div>
                    @endif

                    <script>
                        setTimeout(function () {
                            document.getElementById('success-message')?.remove();
                            document.getElementById('error-message')?.remove();
                        }, 10000);
                    </script>

            <div class="p-6 rounded-lg border border-gray-300 dark:border-gray-700 mb-8 bg-transparent shadow">
                <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">Set Leave Days for All Employees</h2>

                <form method="POST" action="{{ route('admin.leaves.updateAllEmployees') }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label class="block text-gray-600 dark:text-gray-400 mb-2">Leave Days:</label>
                        <input type="number" name="total_leave_days" min="0" required class="w-28 px-3 py-2 border border-blue-400 rounded bg-transparent text-black-800 dark:text-white-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded shadow">
                        Update Leave days for All Employees
                    </button>
                </form>
            </div>

            <div class="p-6 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent shadow">
                <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-6">Set Leave Days for Each Employee</h2>

                @foreach ($employees as $employee)
                    <form method="POST" action="{{ route('admin.leaves.updateLeaveDays', $employee->id) }}" class="mb-4 p-4 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent shadow">
                        @csrf
                        @method('PATCH')

                        <p class="mb-2 text-gray-700 dark:text-gray-300 font-medium">
                            {{ $employee->first_name }} {{ $employee->last_name }}
                            <span class="text-sm text-black-500 dark:text-white-400">({{ $employee->email }})</span>
                        </p>

                        <div class="flex items-center space-x-3">
                            <label class="mr-2 text-gray-600 dark:text-gray-400 whitespace-nowrap">Leave Days:</label>
                            <input type="number" name="total_leave_days" value="{{ $employee->total_leave_days }}" class="w-24 px-3 py-1 mr-2 border border-blue-400 rounded bg-transparent text-black-800 dark:text-white-200 focus:outline-none focus:ring-2 focus:ring-blue-500">

                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded shadow">
                                Update
                            </button>
                        </div>
                    </form>
                @endforeach

                <x-pagination-tailwind :items="$employees" />
            </div>
        </div>
    </div>
</x-admin-layout>
