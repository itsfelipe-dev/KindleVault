<div>
    <x-slot name="header"> {{ $book->title }}</x-slot>
    <x-slot name="subtitle"> {{ $book->author }}</x-slot>

    @foreach ($groupedHighlights as $chapter => $highlights)
        <h1 class="mt-5 mb-5 text-2xl font-bold "> Chapter {{ $chapter }}</h1>
        @foreach ($highlights as $highlight)
           <a href="{{ route('highlights.show', $highlight->id) }}" class="block">
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
    </div>
</a>
        @endforeach
    @endforeach
</div>
