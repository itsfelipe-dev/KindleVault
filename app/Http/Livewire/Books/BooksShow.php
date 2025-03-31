<?php

namespace App\Http\Livewire\Books;

use Livewire\Component;
use App\Models\Book;
use Livewire\WithPagination;
class BooksShow extends Component
{
    public Book $book;
    use WithPagination;

    public function mount(Book $book)
    {
        $this->book = $book;
    }
    public $expandedChapter = null; // Tracks which chapter is open

    public function toggleChapter($chapter)
    {
        $this->expandedChapter = $this->expandedChapter === $chapter ? null : $chapter;
    }
    public function render()
    {
        $highlights = $this->book->highlights()
            ->orderBy('chapter')
            ->orderBy('location')
            ->get();

        $groupedHighlights = $highlights->groupBy('chapter');

        return view('livewire.highlights.index', [
            'groupedHighlights' => $groupedHighlights,
            'book' => $this->book
        ]);
    }
}
