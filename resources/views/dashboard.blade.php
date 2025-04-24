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
            <div class="bg-white w-full p-3 rounded-lg flex gap-8 mb-3">
                <div class="flex flex-col gap-3 w-full">
                    <div class="flex items-center justify-between">
                        <h2 class="font-bold text-xl">Points</h2>
                    </div>
                    <div class="text-white bg-yellow-500 w-full p-4 flex rounded min-w-64">
                        <div class="w-full flex items-center justify-center flex-col">
                            <h2 class="font-bold">{{auth()->user()->points->value}}</h2>
                            <span class="text-blue-100">Current Points</span>
                        </div>
                        <div class="border-[1px]"></div>
                        <div class="w-full flex items-center justify-center flex-col">
                            <h2 class="font-bold">{{auth()->user()->points->total}}</h2>
                            <span class="text-blue-100">Lifetime Points</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-3 w-full">
                    <div class="flex items-center justify-between">
                        <h2 class="font-bold text-xl">Today's Tasks</h2>
                    </div>
                    <div class="text-white bg-emerald-500 w-full p-4 flex rounded min-w-64">
                        <div class="w-full flex items-center justify-center flex-col">
                            <h2 class="font-bold">{{$pendingTasks->count()}}</h2>
                            <span class="text-blue-100">Pending</span>
                        </div>
                        <div class="border-[1px]"></div>
                        <div class="w-full flex items-center justify-center flex-col">
                            <h2 class="font-bold">{{$completedTasks->count()}}</h2>
                            <span class="text-blue-100">Completed</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-3 w-full">
                    <div class="flex items-center justify-between">
                        <h2 class="font-bold text-xl">Orders</h2>
                        <a href="{{route('orders.create')}}" class='inline-flex items-center p-0.5 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg></a>
                    </div>
                    <div class="text-white bg-cyan-500 w-full p-4 flex rounded min-w-64">
                        <div class="w-full flex items-center justify-center flex-col">
                            <h2 class="font-bold">{{auth()->user()->orders()->count()}}</h2>
                            <span class="text-blue-100">Pending</span>
                        </div>
                        <div class="border-[1px]"></div>
                        <div class="w-full flex items-center justify-center flex-col">
                            <h2 class="font-bold">{{auth()->user()->orders()->where('status', 'completed')->count()}}</h2>
                            <span class="text-blue-100">Completed</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <div class="bg-white w-full p-3 rounded-lg flex flex-col gap-8 mb-3">
                    <h1 class="text-xl font-bold">Earning Report</h1>
                    <canvas id="earningReport"></canvas>
                </div>
            </div>

            <script defer>
                const chartData = {!!json_encode($chartData)!!};
                document.addEventListener('DOMContentLoaded', function () {
                    const ctx = document.getElementById('earningReport');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: chartData.labels,
                            datasets: [{
                                label: 'Daily Earnings',
                                data: chartData.data,
                                backgroundColor: 'rgba(54, 162, 235, 0.7)'
                            }]
                        }
                    });
                })
            </script>
            @endrole
        </div>
    </div>
</x-app-layout>
