<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($task->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Task Details -->
                <div class="p-6">
                    <h1 class="text-2xl font-bold mb-2 text-gray-800">{{$task->name}}</h1>

                    <p class="mb-3">
                    Visit Website To Start Timer:
                      <a
                        id="action"
                        href="{{$task->link}}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-blue-500 hover:underline"
                      >
                        {{$task->link}}
                      </a>
                    </p>

                    <div class="flex flex-wrap gap-4 mb-4 text-sm">
                        <div class="flex items-center text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Duration: <span class="font-medium ml-1">{{$task->time}} Seconds</span>
                        </div>
                        <div class="flex items-center text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Reward: <span class="font-medium ml-1">{{$task->reward}} Points</span>
                        </div>
                    </div>

                    <div class="prose max-w-none">
                        <p class="text-gray-700">{{$task->description}}</p>

                        <h2 class="text-xl font-semibold mt-6 mb-2">Instructions</h2>
                        <ol class="list-decimal list-inside space-y-2 text-gray-700">
                            <li>Visit the website and use it for {{$task->time}} seconds</li>
                            <li>Complete Task button will be activated</li>
                            <li>Claim your earned rewards by clicking the Complete Task.</li>
                        </ol>
                    </div>

                    <div class="mt-8 flex gap-3 items-center justify-end">

                        <a href="{{route('tasks.index')}}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
                            Back to Tasks
                        </a>
                        @role('User')
                        @if (!$task->isCompleted(auth()->user()))
                        <form action="{{route('completed-tasks.create', [ 'task'=> $task->id ])}}" method="POST">
                            @csrf
                            <input type="hidden" name="watch_time" id="watchTimeInput" value="0">
                            <button
                                type="submit"
                                id="timeRemaining"
                                disabled
                                class="disabled:opacity-50 disabled:cursor-not-allowed px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors"
                            >
                                Complete Task <span>{{$task->time}}</span>
                            </button>
                        </form>
                        @else
                            <span
                                class="px-4 py-2 bg-green-600 text-white rounded-md flex items-center gap-3"
                            >
                                <span>Task Completed</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-icon lucide-circle-check"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                            </span>
                        @endif
                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const url = "{{ $task->link }}";

        let watchTime = 0;
        const taskTime = {{$task->time}};
        let watchInterval = null;

        const timeRemainingButton = document.getElementById('timeRemaining');
        const watchTimeInput = document.getElementById('watchTimeInput');

        function startTimer() {
            if (!watchInterval) {
                watchInterval = setInterval(() => {
                    if (watchTime < taskTime) {
                        watchTime++;
                        timeRemainingButton.querySelector('span').textContent = taskTime - watchTime;
                        watchTimeInput.value = watchTime;

                        if (watchTime >= taskTime) {
                            timeRemainingButton.disabled = false;
                        }
                        // Optional: Trigger task unlock here after X seconds
                    }
                }, 1000);
            }
        }

        function stopTimer() {
            if (watchInterval) {
                clearInterval(watchInterval);
                watchInterval = null;
            }
        }

        const actionLink = document.getElementById('action');
        actionLink.addEventListener('click', () => {
            startTimer();
        });

    </script>
</x-app-layout>
