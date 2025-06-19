<x-app-layout>

    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">EMS</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="#!" class="text-slate-400 dark:text-zink-200">Attendance</a>
                </li>
            </ul>
        </div>

      <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">

    <div class="col-span-12">
        <div class="relative overflow-hidden card bg-slate-900">
            <div class="relative card-body">
                <div class="grid items-center grid-cols-12">
                    <div class="col-span-12 lg:col-span-8 2xl:col-span-7">
                        <h5 class="mb-3 font-normal tracking-wide text-slate-200">
                            Hi {{ auth()->user()->first_name }} 👋<br>
                            <p>Check your attendance records</p> <br> 
                            <p>Stay consistent, stay successful!</p>
                        </h5> 
                        <form method="GET" action="{{ route('attendance.checkIn') }}"> 
                            <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-500/20 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-500/20 dark:ring-custom-400/20">Check In</button>
                        </form> 
                    </div>
                    <div class="hidden col-span-12 2xl:col-span-3 lg:col-span-2 lg:col-start-11 2xl:col-start-10 lg:block">
                        <img src="assets/images/employeebg.png" alt="..." class="w-80 h-40 object-cover ltr:2xl:ml-auto rtl:2xl:mr-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-span-12">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-4 text-15">Your Attendance Records</h6>

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

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="ltr:text-left rtl:text-right">      
                            <tr class="bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold uppercase text-gray-600 dark:text-gray-300">
                                <th class="px-4 py-2">Date</th>
                                <th class="px-4 py-2">Branch</th>
                                <th class="px-4 py-2">Check In</th>
                                <th class="px-4 py-2">Check Out</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($attendanceRecords as $attendance)
                                <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-2">
                                        {{ \Carbon\Carbon::parse($attendance->attendance_date)->format('M d, Y') }}
                                        <span class="text-xs text-gray-500 block">
                                            {{ \Carbon\Carbon::parse($attendance->attendance_date)->format('l') }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">{{ $attendance->branch }}</td>
                                    <td class="px-4 py-2">
                                        @if($attendance->check_in)
                                            {{ \Carbon\Carbon::parse($attendance->check_in)->format('h:i A') }}
                                            @if ($attendance->is_late)
                                                <span class="text-xs text-red-600 font-semibold ml-2">Late</span>
                                            @else
                                                <span class="text-xs text-green-600 font-semibold ml-2">On Time</span>
                                            @endif
                                        @else
                                            <span class="text-gray-400">--</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        @if($attendance->check_out)
                                            {{ \Carbon\Carbon::parse($attendance->check_out)->format('h:i A') }}
                                        @else
                                            <span class="px-2 py-1 rounded-full text-sm font-semibold bg-transparent text-yellow-600 border border-yellow-500">
                                                Still Working
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                        No attendance records found. Start by marking your attendance!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <x-pagination-tailwind :items="$attendanceRecords" />
                </div>
            </div>
        </div>
    </div>

</div>

</x-app-layout>