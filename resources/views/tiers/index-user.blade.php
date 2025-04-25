<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tiers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex gap-3 flex-wrap">
            @foreach($tiers as $tier)
            <div class="rounded-md shadow w-72 h-fit p-3 bg-white flex flex-col gap-3 relative">
                <h1 class="text-xl font-bold w-full flex items-center justify-center">
                    <span>{{$tier->name}}</span>
                    <span class="absolute left-3">{{$tier->badge}}</span>
                </h1>

                <h2 class="text-xl">Benefits</h2>
                <div class="whitespace-pre-line mb-8">{{trim($tier->benefits)}}</div>


                <h2 class="text-xl">How do I become {{$tier->name}}?</h2>
                @if ($tier->default)
                <p>You are by default bronze</p>
                @else
                <p>{{ $tier->required_tasks }} tasks in the last {{ $tier->days_threshold }} days</p>
                @endif

            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
