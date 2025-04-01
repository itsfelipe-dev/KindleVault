<?php

namespace App\Mail;

use App\Models\Highlight;
use App\Models\Book;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendHighlightEmail extends Mailable
{
    use Queueable, SerializesModels;
    // public $highlightText;
    public $bookDetails;
    public $highlight;
    /**
     * Create a new message instance.
     *
     * @param Highlight $highlight
     */
    public function __construct(Highlight $highlight, Book $bookDetails )
    {
        $this->highlight = $highlight;
        $this->bookDetails = $bookDetails;

    }
    public function build()
    {
        return $this->subject('📖 Your Daily Highlight')
            ->view('emails.highlight')
            ->with([
                'highlightText' => $this->highlight->text,
                'book' =>$this->bookDetails,
            ]);
    }

}
