<div>
    <x-slot name="header"> {{ $highlight->book->title }}</x-slot>
    <x-slot name="subtitle"> {{ $highlight->book->author }}</x-slot>
    <x-mary-ui.card-highlight :$highlight />


    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div>
        <h3 class="mb-3 text-xl font-semibold">{{ $highlight->note ? 'Edit Note' : 'Add Note' }}</h3>
        <form wire:submit.prevent="createNote">
            <div class="form-group">
                <x-mary-textarea id="noteContent" wire:model="noteContent" class="form-control textarea-ghost "
                    placeholder="Enter your note here..." rows="5"></x-mary-textarea>
                @error('noteContent')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <x-mary-button type="submit" class="mt-2 btn btn-neutral">
                {{ $highlight->note ? 'Update Note' : 'Save Note' }}
            </x-mary-button>
        </form>
    </div>
</div>
