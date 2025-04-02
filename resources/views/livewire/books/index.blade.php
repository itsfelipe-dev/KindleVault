<div>
    <x-slot name="header"> {{ __('Books') }}
    </x-slot>
    <div class="">
        <div class="mx-auto max-w-7xl sm:px-5 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-3">
                @foreach ($books as $book)
                    <x-mary-ui.card-pd :$book />
                @endforeach
            </div>
        </div>
    </div>
</div>
