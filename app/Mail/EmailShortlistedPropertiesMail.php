<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailShortlistedPropertiesMail extends Mailable
{
    use Queueable, SerializesModels;    
     public $mail;
     

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $mail )
    {
        $this->mail = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->from('coworkingspace@gmail.com')
       ->subject($this->mail['subject'])
       ->view('emails.shortlisted-properties')
       ->with('mail', $this->mail);
       
    }
}
