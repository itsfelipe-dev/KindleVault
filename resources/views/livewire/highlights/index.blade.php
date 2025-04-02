<div>
    <x-slot name="header"> {{ $book->title }}</x-slot>
    <x-slot name="subtitle"> {{ $book->author }}</x-slot>

    @foreach ($groupedHighlights as $chapter => $highlights)
        <h1 class="mt-5 mb-5 text-2xl font-bold "> Chapter {{ $chapter }}</h1>
        @foreach ($highlights as $highlight)
            <a href="{{ route('highlights.show', $highlight->id) }}" class="block">
                     <x-mary-ui.card-highlight :$highlight />
            </a>
        @endforeach
    @endforeach
</div>
