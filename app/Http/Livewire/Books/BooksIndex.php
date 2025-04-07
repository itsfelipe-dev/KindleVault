<?php

namespace App\Http\Livewire\Books;

use Livewire\Component;

// class BooksIndex extends Component
// {
//     public function render()
//     {
//         return view('livewire.books.index');
//     }
// }




// namespace App\Http\Livewire;

// use Livewire\Component;
use App\Models\Book;

class BooksIndex extends Component
{
    public $books;

    public function mount()
    {
        $this->books = Book::whereHas('highlights', function ($query) {
            $query->where('user_id', auth()->id());
        })
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.books.index');
    }
}