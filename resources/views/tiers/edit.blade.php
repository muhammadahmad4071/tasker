<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tier') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('tiers.edit', ['tier' => $tier]) }}" method="POST" class="space-y-6">
                @csrf
                <!-- tier Name -->
                <div>
                    <label for="tierName" class="block text-sm font-medium text-gray-700 mb-1">Tier Name</label>
                    <input
                        type="text"
                        id="tierName"
                        value="{{$tier->name}}"
                        name="name"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter tier name"
                    >
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="badge" class="block text-sm font-medium text-gray-700 mb-1">Badge</label>
                    <input
                        type="text"
                        value="{{$tier->badge}}"
                        id="badge"
                        name="badge"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="What is the badge/logo of the tier? Emojis are allowed"
                    >
                    @error('badge')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- tier Description -->
                <div>
                    <label for="tierBenefits" class="block text-sm font-medium text-gray-700 mb-1">Benefits</label>
                    <textarea
                        id="tierBenefits"
                        name="benefits"
                        rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter tier benefits"
                    >{{trim($tier->benefits)}}</textarea>
                    @error('benefits')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="requiredTasks" class="block text-sm font-medium text-gray-700 mb-1">Required Tasks</label>
                    <input
                        id="requiredTasks"
                        value="{{$tier->required_tasks}}"
                        placeholder="How many tasks required for the tier?"
                        name="required_tasks"
                        min="0"
                        type="number"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                    @error('required_tasks')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="daysThreshold" class="block text-sm font-medium text-gray-700 mb-1">Threshold In Days</label>
                    <input
                        type="number"
                        placeholder="How many days for the tier?"
                        value="{{$tier->days_threshold}}"
                        min="0"
                        id="daysThreshold"
                        name="days_threshold"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                    @error('days_threshold')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex gap-3 items-center">
                    <input type="checkbox" name="default" id="default" class="border-gray-300 rounded-md"
                    @if ($tier->default) checked="checked" @endif
                    >
                    <label for="default">Default Tier?</label>
                </div>
                @error('days_threshold')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 pt-4 items-center">
                    @if (session('status') === 'updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600"
                        >{{ __('Saved.') }}</p>
                    @endif
                    <a
                        href="{{route('tiers.index')}}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors"
                    >
                        Cancel
                    </a>
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors"
                    >
                        Update Tier
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
