<x-app-layout>
    <style>
        /* Custom video player styles */
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            background-color: #000;
        }

        .video-container iframe,
        .video-container .video-placeholder {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .custom-controls {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.5);
            padding: 10px;
            display: flex;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .video-container:hover .custom-controls {
            opacity: 1;
        }

        .play-pause-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background-color 0.2s;
        }

        .play-pause-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Hide YouTube controls */
        .video-container iframe {
            pointer-events: none; /* Disable direct interaction with iframe */
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($task->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Video Player -->
                <div class="video-container" id="videoContainer">
                    <div class="video-placeholder bg-gray-800 flex items-center justify-center" id="videoPlaceholder">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div id="player"></div>
                    <div class="custom-controls">
                        <button class="play-pause-btn" id="playPauseBtn" aria-label="Play">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="playIcon">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="pauseIcon">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Task Details -->
                <div class="p-6">
                    <h1 class="text-2xl font-bold mb-2 text-gray-800">{{$task->name}}</h1>

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
                            <li>Watch the video up until the duration is complete</li>
                            <li>Complete Task button will be activated</li>
                            <li>Claim your earned rewards by clicking the Complete Task.</li>
                        </ol>
                    </div>

                    <div class="mt-8 flex gap-3 items-center justify-end">

                        <a href="{{route('tasks.index')}}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
                            Back to Tasks
                        </a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const videoUrl = "{{ $task->video }}";

        let watchTime = 0;
        const taskTime = {{$task->time}};
        let watchInterval = null;
        let isTabVisible = true;

        // const videoId = 'dQw4w9WgXcQ'; // Example: Rick Astley - Never Gonna Give You Up
        let player;
        let isPlaying = false;

        // Load YouTube API
        const tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        const firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        function getYouTubeVideoId(url) {
            const regex = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w\-]+)/;
            const match = url.match(regex);
            return match ? match[1] : null;
        }

        // Create YouTube player when API is ready
        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                height: '100%',
                width: '100%',
                videoId: getYouTubeVideoId(videoUrl),
                playerVars: {
                    'autoplay': 0,
                    'controls': 0,
                    'modestbranding': 1,
                    'rel': 0,
                    'showinfo': 0,
                    'fs': 0,
                    'iv_load_policy': 3
                },
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }

        // When player is ready
        function onPlayerReady(event) {
            document.getElementById('videoPlaceholder').style.display = 'none';

            // Set up play/pause button
            const playPauseBtn = document.getElementById('playPauseBtn');
            playPauseBtn.addEventListener('click', function() {
                if (isPlaying) {
                    player.pauseVideo();
                } else {
                    player.playVideo();
                }
            });
        }

        // When player state changes
        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.PLAYING) {
                isPlaying = true;
                document.getElementById('playIcon').classList.add('hidden');
                document.getElementById('pauseIcon').classList.remove('hidden');
                if (isTabVisible) startTimer();
            } else {
                isPlaying = false;
                document.getElementById('playIcon').classList.remove('hidden');
                document.getElementById('pauseIcon').classList.add('hidden');
                stopTimer();
            }
        }

        // Enable pointer events when controls are hovered
        const videoContainer = document.getElementById('videoContainer');
        const customControls = document.querySelector('.custom-controls');

        customControls.addEventListener('mouseenter', function() {
            const iframe = videoContainer.querySelector('iframe');
            if (iframe) iframe.style.pointerEvents = 'auto';
        });

        customControls.addEventListener('mouseleave', function() {
            const iframe = videoContainer.querySelector('iframe');
            if (iframe) iframe.style.pointerEvents = 'none';
        });

        const timeRemainingButton = document.getElementById('timeRemaining');
        const watchTimeInput = document.getElementById('watchTimeInput');
        function startTimer() {
            if (!watchInterval) {
                watchInterval = setInterval(() => {
                    if (isPlaying && isTabVisible && watchTime < taskTime) {
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

        document.addEventListener('visibilitychange', () => {
            isTabVisible = !document.hidden;

            if (isTabVisible && isPlaying) {
                startTimer();
            } else {
                stopTimer();
            }
        });
    </script>
</x-app-layout>
