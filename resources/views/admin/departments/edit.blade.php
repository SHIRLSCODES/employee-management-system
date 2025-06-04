<x-admin-layout>
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Departments</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('dashboard') }}" class="text-slate-400 dark:text-zink-200">Home</a>
                </li>
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('admin.departments.index') }}" class="text-slate-400 dark:text-zink-200">Departments</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">
                    Edit
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.departments.update', $department->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <h6 class="mb-4 text-gray-800 text-16 dark:text-zink-50">Edit Department</h6>
                    <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                        <div class="xl:col-span-6">
                           <label for="name" class="inline-block mb-2 text-base font-medium">Name:</label>
                           <x-text-input type="text" id="name" name="name" value="{{ old('name', $department->name) }}" placeholder="E.g: Human Resource" required/>
                           <x-input-error :messages="$errors->get('name')" class="mt-2" />
                       </div>
                       <div class="xl:col-span-6">
                           <label for="code" class="inline-block mb-2 text-base font-medium">Short Name:</label>
                           <x-text-input type="text" id="code" name="code" value="{{ old('code', $department->code) }}" placeholder="E.g: HR" required/>
                           <x-input-error :messages="$errors->get('code')" class="mt-2" />
                       </div><!--end col-->
                   </div>
                   <div>
                       <label for="description" class="inline-block mb-2 text-base font-medium">Description:</label>
                       <x-text-area id="description" name="description">{{ old('description', $department->description) }}</x-text-area>
                       <x-input-error :messages="$errors->get('description')" class="mt-2" />
                   </div>

                    <div class="flex justify-end gap-2 mt-5">
                        <a href="{{ route('admin.departments.index') }}" class="btn bg-slate-200 text-slate-600 hover:bg-slate-300 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-zink-500">Cancel</a>
                        <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
