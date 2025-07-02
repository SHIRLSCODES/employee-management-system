<x-admin-layout>
    <div class="container mx-auto py-8">
        <div class="p-6 rounded-xl">

            <h1 class="text-3xl font-bold text-gray-700 dark:text-gray-300 mb-6">Attendance Setup</h1>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-500 text-white rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.attendance.updateLatenessTime') }}">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label class="block text-gray-600 dark:text-gray-400 mb-2">Lateness Time (HH:MM format):</label>
                    <input type="time" name="lateness_time" value="{{ old('lateness_time', $latenessTime ?? '') }}"
                           class="w-40 px-3 py-2 border border-blue-400 rounded bg-transparent text-black-800 dark:text-white-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded shadow">
                    Update Lateness Time
                </button>
            </form>
        </div>
    </div>
</x-admin-layout>
