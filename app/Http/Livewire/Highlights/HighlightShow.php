<?php

namespace App\Http\Livewire\Highlights;

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
use App\Models\Highlight;
use Mary\Traits\Toast;
// use Livewire\Component;

use App\Models\Note;
// use Livewire\WithValidation;

class HighlightShow extends Component
{
    use Toast;
    public Highlight $highlight;
    public string $noteContent = ''; // Initialize as empty string

    protected $rules = [
        'noteContent' => 'required|string|max:255',
    ];

    public function mount(Highlight $highlight)
    {
        $this->highlight = $highlight;
        // Load existing note content if available
        if ($highlight->note) {
            $this->noteContent = $highlight->note->text;
        }
    }

    public function createNote()
    {
        $this->validate();

        if ($this->highlight->note) {
            // Update existing note
            $this->highlight->note->update([
                'text' => $this->noteContent
            ]);
        } else {
            // Create new note
            $this->highlight->note()->create([
                'text' => $this->noteContent,
            ]);
        }

        // $this->highlight->refresh(); 
        $this->success("Note saved successfully!");
    }

    public function render()
    {
        return view('livewire.highlights.show', [
            'highlight' => $this->highlight->load('note'),
        ]);
    }
}