<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ !$notebook->trashed() ? __('Notebooks') : __('Trashed') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @can('view', $notebook)
                <x-alert-success>
                    {{ session('success') }}
                </x-alert-success>
                <div class="flex">
                    @if(!$notebook->trashed())
                        <x-header-not-trashed :note="$notebook"></x-header-not-trashed>
                    @else
                        <x-header-trashed :note="$notebook"></x-header-not-trashed>
                    @endif
                </div>
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-4xl">
                        {{ $notebook->title }}
                    </h2>
                    <p class="mt-6 mb-3 whitespace-pre-wrap">{{ $notebook->description }}</p>
                    
                    <ul>
                        {{-- {{ dump($notes) }}</li> --}}
                        @foreach($notes as $note)
                            <li>
                                {{ $note->id }}. {{  $note->title }}
                        @endforeach
                    </ul>

                    <x-visibility :is_public="$notebook->is_public"></x-visibility>
                </div>
            @else
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <p>
                        {{ $response }}
                    </p>
                </div>
            @endcan
        </div>
    </div>
</x-app-layout>
