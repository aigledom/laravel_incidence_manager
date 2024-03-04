<?php

namespace App\Mail;

use App\Models\Incidencia;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailAvisoIncidencia extends Mailable
{
    use Queueable, SerializesModels;

    var $nombreUsuario;
    var $incidencia;
    var $nombreCategoria;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombreUsuario, Incidencia $incidencia, $nombreCategoria)
    {
        // Inicializar las propiedades con los parámetros
        $this->nombreUsuario = $nombreUsuario;
        $this->incidencia = $incidencia;
        $this->nombreCategoria = $nombreCategoria;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Nueva Incidencia Asignada:',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }

    public function build()
    {
        // Utiliza las propiedades en la construcción del mensaje
        return $this->subject('Aviso de incidencia')->view('mail')->with([
            'nombreUsuario' => $this->nombreUsuario,
            'incidencia' => $this->incidencia,
            'nombreCategoria' => $this->nombreCategoria,
        ]);
    }
}
