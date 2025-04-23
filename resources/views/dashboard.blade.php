<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @role('Admin')
                {{ __('Admin') }}
            @endrole
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @role('User')
            <div class="bg-white w-fit p-3 rounded-lg flex gap-8">
                <div class="flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <h2 class="font-bold text-xl">Orders</h2>
                        <a href="{{route('orders.create')}}" class='inline-flex items-center p-0.5 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg></a>
                    </div>
                    <div class="text-white bg-blue-600 w-full p-4 flex rounded min-w-64">
                        <div class="w-full flex items-center justify-center flex-col">
                            <h2 class="font-bold">{{auth()->user()->orders()->count()}}</h2>
                            <span class="text-blue-100">Pending</span>
                        </div>
                        <div class="border-[1px]"></div>
                        <div class="w-full flex items-center justify-center flex-col">
                            <h2 class="font-bold">{{auth()->user()->orders()->count()}}</h2>
                            <span class="text-blue-100">Completed</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <h2 class="font-bold text-xl">Tasks</h2>
                    </div>
                    <div class="text-white bg-green-500 w-full p-4 flex rounded min-w-64">
                        <div class="w-full flex items-center justify-center flex-col">
                            <h2 class="font-bold">{{$totalPending}}</h2>
                            <span class="text-blue-100">Pending</span>
                        </div>
                        <div class="border-[1px]"></div>
                        <div class="w-full flex items-center justify-center flex-col">
                            <h2 class="font-bold">{{auth()->user()->tasks()->count()}}</h2>
                            <span class="text-blue-100">Completed</span>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="mt-8 mb-3 font-bold text-xl">Today's Pending Tasks</h1>
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                  >
                    Name
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                  >
                    Description
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                  >
                    URL
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                  >
                    Duration (sec)
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                  >
                    Reward
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                  >
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($pendingTasks as $task)
                  <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm font-medium text-gray-900">{{$task->name}}</div>
                    </td>
                    <td class="px-6 py-4">
                      <div class="text-sm text-gray-500 max-w-xs truncate">{{$task->description}}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <a
                        href="{{$task->link}}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800"
                      >
                        {{$task->link}}
                      </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-500">{{$task->time}}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm font-medium text-emerald-600">{{$task->reward}}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      <div class="flex space-x-2">
                        @role('Admin')
                        <a
                          href={{route('tasks.edit', ['task' => $task])}}
                          class="p-1 rounded-full hover:bg-gray-100 text-blue-600 hover:text-blue-800 transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil-icon lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                        </a>
                        <form action="{{route('tasks.delete', ['task' => $task])}}" method="POST" class="inline">
                            @csrf
                            @method("DELETE")
                            <button
                              class="p-1 rounded-full hover:bg-gray-100 text-red-600 hover:text-red-800 transition-colors"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                            </button>
                        </form>
                        @else
                            <a
                              href={{route('tasks.show', ['task' => $task])}}
                              class="p-1 rounded-full hover:bg-gray-100 text-blue-600 hover:text-blue-800 transition-colors"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                            </a>
                        @endrole
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            @endrole
        </div>
    </div>
</x-app-layout>
