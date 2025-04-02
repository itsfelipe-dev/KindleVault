@props(['book'])


<a href="{{ route('books.show', $book->id) }}"
    class="flex items-center max-w-lg gap-4 p-4 rounded-lg shadow-lg bg-base-200">
    <div class="flex-shrink-0 w-20 h-28">
        <img class="object-cover w-full h-full rounded-lg"
            src="https://store.crescentbook.com.my/wp-content/uploads/2024/07/WhatsApp-Image-2024-06-29-at-12.14.57_acbd033a.jpg"
            alt="Book Cover">
    </div>

    <div class="flex-1">
        <h2 class="text-lg font-bold">{{ $book->title }}</h2>
        <p class="text-gray-600">By {{ $book->author }}</p>
    </div>
    <div>
        <x-heroicon-o-arrow-right class="w-6 h-6 text-gray-500 hover:text-gray-50" />
    </div>
</a>
