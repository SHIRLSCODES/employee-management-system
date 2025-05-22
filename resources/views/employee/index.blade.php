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
                <li class="text-slate-700 dark:text-zink-100">
                    Employees
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-body">
                <h6 class="mb-4 text-15">All Employees</h6>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="ltr:text-left rtl:text-right">
                            <tr>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Employee No</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Name</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Email</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Phone Number</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd:bg-white even:bg-slate-50 dark:odd:bg-zink-700 dark:even:bg-zink-600">
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500"><a href="#!" class="transition-all duration-150 ease-linear text-custom-500 hover:text-custom-600">#EMP-00001</a></td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">Shirley Alalade</td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">shirls@gmail.com</td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">09090384903</td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500"><a href="#!" class="transition-all duration-150 ease-linear text-custom-500 hover:text-custom-600"><i class="ri-download-2-line"></i></a></td>
                            </tr>
                            <tr class="odd:bg-white even:bg-slate-50 dark:odd:bg-zink-700 dark:even:bg-zink-600">
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500"><a href="#!" class="transition-all duration-150 ease-linear text-custom-500 hover:text-custom-600">#EMP-00002</a></td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">Okoduwa Marcus</td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">oko@gmail.com</td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">07039482039</td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500"><a href="#!" class="transition-all duration-150 ease-linear text-custom-500 hover:text-custom-600"><i class="ri-download-2-line"></i></a></td>
                            </tr>
                            <tr class="odd:bg-white even:bg-slate-50 dark:odd:bg-zink-700 dark:even:bg-zink-600">
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500"><a href="#!" class="transition-all duration-150 ease-linear text-custom-500 hover:text-custom-600">#EMP-00003</a></td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">Jeffery Dman</td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">bigmanjef@gmail.com</td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">08039483940</td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500"><a href="#!" class="transition-all duration-150 ease-linear text-custom-500 hover:text-custom-600"><i class="ri-download-2-line"></i></a></td>
                            </tr>
                            <tr class="odd:bg-white even:bg-slate-50 dark:odd:bg-zink-700 dark:even:bg-zink-600">
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500"><a href="#!" class="transition-all duration-150 ease-linear text-custom-500 hover:text-custom-600">#EMP-00005</a></td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">Ejo Unoderest</td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">ejo@gmail.com</td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">08129384952</td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500"><a href="#!" class="transition-all duration-150 ease-linear text-custom-500 hover:text-custom-600"><i class="ri-download-2-line"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>