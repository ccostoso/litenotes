<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('notes.update', $note) }}" method="post">
                    @method('put')
                    @csrf
                    
                    <x-text-input 
                        type="text" 
                        name="title" 
                        field="title" 
                        placeholder="Enter title here" 
                        class="w-full" 
                        autocomplete="off"
                        :value="@old('title', $note->title)"
                        ></x-text-input>

                    <x-textarea 
                    name="text" 
                    field="text" 
                    rows="10" 
                    placeholder="Start typing here..." 
                    class="w-full mt-6"
                    :value="@old('text', $note->text)"
                    ></x-textarea>

                    @if($note->is_public)
                        <p class="opacity-70">
                            <small>Note is currently visible to all</small>
                        </p>
                    @else
                        <p class="opacity-70">
                            <small>Note is currently private</small>
                        </p>
                    @endif
                    <div class="flex">
                        <div class="flex items-center h-5">
                            <input type="checkbox" 
                            name="is_public"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="ml-2 text-sm">
                            <label for="helper-checkbox" class="font-medium text-gray-900 dark:text-gray-300">Make note public</label>
                            <p class="text-xs font-normal text-gray-500 dark:text-gray-300">Checking this box will make this note visibile to all users.</p>
                        </div>
                    </div>

                    <x-primary-button class="mt-6">Save</x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
