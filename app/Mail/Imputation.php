<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Imputation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $courrier = [];
    public function __construct($courrier)
    {
        $this->courrier = $courrier;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.Imputation')
        ->subject('nouvelle imputation')
        ->from('no-replay@imputation.com', 'E-Courriel');
    }
}
