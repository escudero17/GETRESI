<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $remitente;
    public $contenido;

    public function __construct($remitente, $contenido)
    {
        $this->remitente = $remitente;
        $this->contenido = $contenido;
    }

    public function build()
    {
        return $this->from($this->remitente)
                    ->subject('Contactanos')
                    ->markdown('emails.contact'); // Vista de correo electrónico en Markdown
    }
}