<div>
      <x-slot name="header"> Upload Highlights</x-slot>
    <x-mary-card title="" subtitle="Upload your Kindle Highlights file">
        @if($uploadError)
            <x-mary-alert icon="o-exclamation-triangle" class="mb-4 alert-error">
                {{ $uploadError }}
            </x-mary-alert>
        @endif

        <x-mary-form wire:submit="save">
            <x-mary-file wire:model="file" label="Kindle Highlights File" accept=".html" />

            <x-slot:actions>
                <x-mary-button label="Save" type="submit" class="btn-primary" spinner="save" :disabled="$isUploading" />
            </x-slot:actions>
        </x-mary-form>

        @if($isUploading)
            <x-mary-progress class="mt-4 progress-primary" indeterminate />
        @endif
    </x-mary-card>

    <!-- Auto-close modal -->
    <x-mary-modal wire:model="showModal" title="Upload Successful 🎉" subtitle="Book Details" separator>
        <div class="text-lg">
            <p><strong>Title:</strong> {{ $bookTitle }}</p>
            <p><strong>Author:</strong> {{ $bookAuthor }}</p>
            <p><strong>Highlights:</strong> {{ $highlightCount }}</p>
        </div>

        <x-slot:actions>
            <x-mary-button label="Close" class="btn-primary" @click="$wire.showModal = false" />
        </x-slot:actions>
    </x-mary-modal>

    <script>
        Livewire.on('close-modal-timer', () => {
            setTimeout(() => {
                @this.showModal = false;
            }, 5000); // Closes the modal in 5 seconds
        });
    </script>
</div>
