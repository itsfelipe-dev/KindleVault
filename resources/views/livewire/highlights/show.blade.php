<div>
    <x-slot name="header"> {{ $highlight->book->title }}</x-slot>
    <x-slot name="subtitle"> {{ $highlight->book->author }}</x-slot>

    <div class="p-10 py-10 mb-5 border-l-4 border-yellow-400 rounded-lg shadow-sm bg-gray-50 dark:bg-gray-800">
        <div>
            <p class="font-serif text-gray-900 dark:text-gray-100">
                {{ $highlight->text }}
            </p>
        </div>

        <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            📍 <strong>Location:</strong> {{ $highlight->location }} |
            📖 <strong>Chapter:</strong> {{ $highlight->chapter }}
        </div>
    </div><!-- Use the actual content field name -->

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div>
        <h3 class="mb-3 text-2xl font-semibold">{{ $highlight->note ? 'Edit Note' : 'Add Note' }}</h3>
        <form wire:submit.prevent="createNote">
            <div class="form-group">
                <x-mary-textarea id="noteContent" wire:model="noteContent" class="form-control"
                    placeholder="Enter your note here..." rows="5"></x-mary-textarea>
                @error('noteContent')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <x-mary-button type="submit" class="mt-2 btn btn-primary">
                {{ $highlight->note ? 'Update Note' : 'Save Note' }}
            </x-mary-button>
        </form>
    </div>
</div>
