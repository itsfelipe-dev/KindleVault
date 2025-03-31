@props(['book'])

<x-mary-card title="{{ $book->title }} " class="p-10">
    {{ $book->author }}
    {{-- {{ $book->cover_url }} --}}

    <x-slot:figure>
        <img src="https://store.crescentbook.com.my/wp-content/uploads/2024/07/WhatsApp-Image-2024-06-29-at-12.14.57_acbd033a.jpg"
             alt="{{ $book->title }} Cover"
             class="object-cover w-full rounded-md h-52">
    </x-slot:figure>
    <x-slot:menu>
        <x-mary-button icon="o-share" class="btn-circle btn-sm" />
        {{-- <x-icon name="o-heart" class="cursor-pointer" /> --}}
    </x-slot:menu>
    <x-slot:actions>

<x-mary-button
    label="View Details"
    link="{{ route('books.show', $book->id) }}"
    icon="o-eye"
    class="btn-primary"
    spinner
    {{-- tooltip="View book details" --}}
    {{-- tooltip-bottom --}}
/>
    </x-slot:actions>
</x-mary-card>