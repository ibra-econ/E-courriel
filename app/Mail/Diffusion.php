<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Diffusion extends Mailable
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
        return $this->markdown('email.Diffision')
        ->subject('nouvelle diffusion')
        ->from('no-replay@diffusion.com', 'E-Courriel');

    }
}
