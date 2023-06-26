<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ request()->routeIs('notebooks.index') ? __('Notebooks') : __('Trash') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            @if(request()->routeIs('notebooks.index'))
                <a href="{{ route('notebooks.create') }}" class="btn-link btn-lg mb-2">+ New Notebook</a>
            @endif

            @forelse ($notebooks as $notebook)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                        <a 
                        @if(request()->routeIs('notes.index'))
                        href="{{ route('notebooks.show', $notebook) }}"
                        @else
                        href="{{ route('trashed.show', $notebook) }}"
                        @endif
                        >{{ $notebook->title }}</a>
                    </h2>
                    <p class="mt-2">
                        {{ Str::limit($notebook->description, 200) }}
                    </p>
                    <span class="block mt-4 text-sm opacity-70">{{ $notebook->updated_at->diffForHumans() }}</span>
                    <x-visibility :is_public="$notebook->is_public"></x-visibility>
                </div>
            @empty
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    @if(request()->routeIs('notebooks.index'))
                        <p>You currently have no notebooks to display. When you create a notebook, it will show up here.</p>
                    @else
                        <p>No items in the trash.</p>
                    @endif
                </div>
            @endforelse

            {{ $notebooks->links() }}
        </div>
    </div>
</x-app-layout>
