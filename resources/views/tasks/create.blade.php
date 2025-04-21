<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="/submit-task" method="POST" class="space-y-6">
                <!-- Task Name -->
                <div>
                    <label for="taskName" class="block text-sm font-medium text-gray-700 mb-1">Task Name</label>
                    <input
                        type="text"
                        id="taskName"
                        name="taskName"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter task name"
                    >
                </div>

                <!-- Task Description -->
                <div>
                    <label for="taskDescription" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea
                        id="taskDescription"
                        name="taskDescription"
                        rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter task description"
                    ></textarea>
                </div>

                <!-- Video Link -->
                <div>
                    <label for="videoLink" class="block text-sm font-medium text-gray-700 mb-1">Video Link</label>
                    <input
                        type="url"
                        id="videoLink"
                        name="videoLink"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="https://example.com/video"
                    >
                </div>

                <!-- Duration -->
                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration (seconds)</label>
                    <input
                        type="number"
                        id="duration"
                        name="duration"
                        min="1"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter duration in seconds"
                    >
                </div>

                <!-- Reward Amount -->
                <div>
                    <label for="rewardAmount" class="block text-sm font-medium text-gray-700 mb-1">Reward Amount ($)</label>
                    <input
                        type="number"
                        id="rewardAmount"
                        name="rewardAmount"
                        min="0"
                        step="0.01"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter reward amount"
                    >
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 pt-4">
                    <a
                        href="index.html"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors"
                    >
                        Cancel
                    </a>
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors"
                    >
                        Create Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
