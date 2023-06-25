<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ !$note->trashed() ? __('Notes') : __('Trashed') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @can('view', $note)
                <x-alert-success>
                    {{ session('success') }}
                </x-alert-success>
                <div class="flex">
                    @if(!$note->trashed())
                        <x-header-not-trashed :note="$note"></x-header-not-trashed>
                    @else
                        <x-header-trashed :note="$note"></x-header-not-trashed>
                    @endif
                </div>
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    @if($note->is_public)
                        <p class="opacity-70">
                            <small>Visible to all</small>
                        </p>
                    @else
                        <p class="opacity-70">
                            <small>Private</small>
                        </p>
                    @endif
                    <h2 class="font-bold text-4xl">
                        {{ $note->title }}
                    </h2>
                    <p class="mt-6 whitespace-pre-wrap">{{ $note->text }}</p>
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
