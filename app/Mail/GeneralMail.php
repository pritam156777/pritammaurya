<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GeneralMail extends Mailable
{
    use SerializesModels;

    public $subjectText;
    public $bodyText;
    public $attachments;

    public function __construct($subjectText, $bodyText, $attachments = [])
    {
        $this->subjectText = $subjectText;
        $this->bodyText = $bodyText;
        $this->attachments = $attachments;
    }

    public function build()
    {
        $mail = $this->subject($this->subjectText)
            ->view('emails.general')
            ->with([
                'bodyText' => $this->bodyText
            ]);

        // Attach files if any
        foreach ($this->attachments as $filePath) {
            $mail->attach($filePath);
        }

        return $mail;
    }
}
