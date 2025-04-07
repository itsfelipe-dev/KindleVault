<?php

namespace App\Http\Livewire\Highlights;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Book;
use App\Models\Highlight;
use DOMDocument;
use DOMXPath;
use Illuminate\Support\Facades\Auth;
use Mary\Traits\Toast;
class HighlightUpload extends Component
{
    use WithFileUploads;
    use Toast;
    public bool $showModal = false;

    public $file;
    public $isUploading = false;
    public $uploadProgress = 0;
    public $uploadComplete = false;
    public $uploadError = null;
    public $bookTitle;
    public $bookAuthor;
    public $highlightCount;

    protected $rules = [
        'file' => 'required|mimes:html',
    ];

    public function save()
    {
        $this->reset(['uploadComplete', 'uploadError', 'bookTitle', 'bookAuthor', 'highlightCount']);

        try {
            $this->isUploading = true;

            $htmlContent = file_get_contents($this->file->getRealPath());
            $dom = new DOMDocument();
            @$dom->loadHTML($htmlContent);
            $xpath = new DOMXPath($dom);

            // Extract book details
            $this->bookTitle = trim($xpath->query("//div[@class='bookTitle']")->item(0)->textContent ?? '');
            $this->bookAuthor = trim($xpath->query("//div[@class='authors']")->item(0)->textContent ?? '');

            // Create or find book
            $book = Book::firstOrCreate([
                'title' => $this->bookTitle,
                'author' => $this->bookAuthor
            ]);

            // Extract highlights
            $highlights = [];
            $currentSection = '';
            $nodes = $dom->getElementsByTagName('div');

            foreach ($nodes as $node) {
                $class = $node->getAttribute('class');

                if ($class === 'sectionHeading') {
                    $currentSection = trim($node->nodeValue);
                    continue;
                }

                if ($class === 'noteHeading') {
                    $highlight = [
                        'section' => $currentSection,
                        'color' => '',
                        'location' => '',
                        'text' => ''
                    ];

                    $headingText = $node->nodeValue;
                    $highlight['color'] = preg_match('/Highlight \((.*?)\)/', $headingText, $matches)
                        ? str_replace(['<span class="highlight_', '">', '</span>'], '', $matches[1])
                        : 'yellow';

                    $highlight['location'] = preg_match('/Location (\d+)/', $headingText, $matches)
                        ? $matches[1]
                        : '';

                    $nextSibling = $node->nextSibling;
                    while ($nextSibling && $nextSibling->nodeName !== 'div') {
                        $nextSibling = $nextSibling->nextSibling;
                    }

                    if ($nextSibling && $nextSibling->getAttribute('class') === 'noteText') {
                        $highlight['text'] = trim($nextSibling->nodeValue);
                    }

                    $highlights[] = $highlight;
                }
            }

            // Save highlights
            foreach ($highlights as $highlightData) {
                Highlight::firstOrCreate([
                    'text' => $highlightData['text'],
                    'book_id' => $book->id,
                    'user_id' => Auth::id(),
                ], [
                    'location' => $highlightData['location'],
                    'chapter' => $highlightData['section'],
                    'color' => $highlightData['color'],
                ]);
            }

            $this->highlightCount = count($highlights);
            $this->uploadComplete = true;
            $this->isUploading = false;
            $this->showModal = true;
            $this->dispatch('close-modal-timer');
            $this->success('We are done, check it out');
        } catch (\Exception $e) {
            $this->uploadError = 'Error processing file: ' . $e->getMessage();
            $this->isUploading = false;
        }
    }


    public function render()
    {
        return view('livewire.highlights.upload');
    }
}
