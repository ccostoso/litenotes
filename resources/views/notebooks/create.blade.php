<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('notebooks.store') }}" method="post">
                    @csrf
                    
                    <x-text-input 
                        type="text" 
                        name="title" 
                        field="title" 
                        placeholder="Enter title here" 
                        class="w-full" 
                        autocomplete="off"
                        :value="@old('title')"
                    ></x-text-input>

                    <x-textarea 
                    name="description" 
                    field="description" 
                    rows="3" 
                    placeholder="Give a description for this notebook" 
                    class="w-full mt-6"
                    :value="@old('description')"
                    ></x-textarea>

                    <ul role="list" class="divide-y divide-gray-100">
                        @forelse ($notes as $note)
                            <li class="flex gap-x-6 py-5">
                                    <div class="flex items-center h-5">
                                        <input type="checkbox" 
                                        name="in_notebook[]"
                                        value="{{ $note->id }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                        >
                                    </div>
                                    <div class="ml-2 text-sm">
                                        <label for="helper-checkbox" class="font-medium text-gray-900 dark:text-gray-300">{{ $note->title }}</label>
                                        <p class="text-xs font-normal text-gray-500 dark:text-gray-300">
                                            {{ Str::limit($note->text, 200) }}
                                        </p>
                                    </div>
                            </li>
                        @empty
                            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                                <p>You currently have no notes to display. When you create a note, it will show up here.</p>
                            </div>
                        @endforelse
                    </ul>
                      

                    <x-primary-button class="mt-6">Save</x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
