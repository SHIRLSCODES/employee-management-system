@foreach ($departments as $department)
                                <tr class="even:bg-slate-50 hover:bg-slate-50 even:hover:bg-slate-100 dark:even:bg-zink-600/50 dark:hover:bg-zink-600 dark:even:hover:bg-zink-600">
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $department->name }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $department->code }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $department->description }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">  
                                        <span class="px-2 py-1 rounded-full text-sm font-semibold border
                                                @if($department->status === 'active') bg-green-600 text-green-600 border-green-500 
                                                @elseif($department->status === 'inactive') bg-yellow-600 text-yellow-600 border-yellow-500 
                                                @else bg-gray-600 text-gray-800 border-gray-400 
                                                @endif
                                            ">
                                                {{ ucfirst($department->status) }}
                                            </span>
                                    </td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                        <div class="flex items">
                                            <a href="{{ route('admin.departments.show', $department->id) }}" class="text-blue-500 hover:text-blue-600 mr-2">View</a>
                                            <a href="{{ route('admin.departments.edit', $department->id) }}" class="text-yellow-600 hover:text-yellow-800 mr-2">Edit</a>
                                            <form action="{{ route('admin.departments.destroy', $department->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this department?');">
                                                @csrf
                                                <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
@endforeach