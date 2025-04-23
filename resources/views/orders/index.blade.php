<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @role('User')
        <div class="mb-3">
            <a href="{{route('orders.create')}}" class="block w-fit py-2 px-8 rounded-lg bg-green-200 text-green-800 transition-colors hover:bg-green-300">Create Order</a>
        </div>
        @endrole
          <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                @role('Admin')
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                  >
                    User
                  </th>
                  @endrole
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                  >
                    Type
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                  >
                    Amount
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
                    Created At
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                  >
                    Status
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($orders as $order)
                  <tr class="hover:bg-gray-50 transition-colors">
                    @role('Admin')
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm font-medium text-gray-900 capitalize">{{$order->user->name}}</div>
                    </td>
                    @endrole
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm font-medium text-gray-900 capitalize">{{$order->type}}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm font-medium text-gray-900">{{$order->amount}}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-500 max-w-xs truncate">{{$order->url}}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-500">{{$order->created_at->diffForHumans()}}</div>
                    </td>
                    @role('Admin')
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 relative" x-data="{ open: false }">
                        <button
                            class="capitalize inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                            @click="open = !open"
                            >
                            {{$order->status}}
                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <form
                            method="POST"
                            action="{{route('orders.updateStatus', [ 'order' => $order ])}}"
                            x-show="open"
                            @click.away="open = false"
                            x-transition
                            x-ref="statusForm"
                            class="origin-top-right absolute bg-white rounded border-[1px] mt-2 z-[70] shadow w-32 flex flex-col gap-1 items-center justify-center"
                        >
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" x-ref="statusInput">
                            <button class="w-full hover:bg-gray-100 rounded p-1" value="pending" type="submit"
                                @click="
                                    $refs.statusInput.value = 'pending';
                                    $refs.statusForm.submit();
                                "
                            >Pending</button>
                            <button class="w-full hover:bg-gray-100 rounded p-1" value="in-progress" type="submit"
                                @click="
                                    $refs.statusInput.value = 'in-progress';
                                    $refs.statusForm.submit();
                                "
                            >In-Progress</button>
                            <button class="w-full hover:bg-gray-100 rounded p-1" value="completed" type="submit"
                                @click="
                                    $refs.statusInput.value = 'completed';
                                    $refs.statusForm.submit();
                                "
                            >Completed</button>
                            <button class="w-full hover:bg-gray-100 rounded p-1" value="cancelled" type="submit"
                                @click="
                                    $refs.statusInput.value = 'cancelled';
                                    $refs.statusForm.submit();
                                "
                            >Cancelled</button>
                        </form>
                    </td>
                    @else
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-500 capitalize">{{$order->status}}</div>
                    </td>
                    @endrole
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>
</x-app-layout>
