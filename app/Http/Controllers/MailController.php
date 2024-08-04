<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $remitente = $request->input('correo');
        $contenido = $request->input('contenido');

        // Correo de destino fijo
        $correoDestino = 'desarrollo@getresi.es'; 
        $asunto = 'Contactanos'; // Asunto fijo o puedes tomarlo del request si es variable

        // Enviar el correo utilizando Mail::html
        Mail::html($contenido, function($msj) use ($remitente, $asunto, $correoDestino) {
            $msj->replyTo($remitente);
            $msj->subject($asunto);
            $msj->to($correoDestino);
        });

        return redirect()->back()->with('success', 'Correo enviado correctamente.');
    }

    // public function sendEmail(Request $request)
    // {

    //     $remitente = $request->correo;
    //     $contenido = $request->contenido;

    //     $correoDestino = 'nikitajaume@gmail.com'; // Correo de destino
    //     $mensaje = $contenido;

    //     Mail::send('emails.contact',$request->all(), 
	// 	function($msj)use ($correoDestino,$mensaje,$remitente) {
	// 	$msj->subject('Contacto: '. $correoDestino)	;
	// 	$msj->to($correoDestino)	;
	// 	});

    //     return redirect()->back()->with('success', 'Correo enviado correctamente.');
    // }
    public function sendReservaEmail(Request $request)
    {
        $remitente = $request->input('correo');
        $asunto = $request->input('asunto');
        $contenido = $request->input('contenido');

        // Correo de destino fijo para reservas
        $correoDestino = 'desarrollo@getresi.es';

        // Enviar el correo utilizando Mail::html
        Mail::html($contenido, function($msj) use ($remitente, $asunto, $correoDestino) {
            $msj->replyTo($remitente);
            $msj->subject($asunto);
            $msj->to($correoDestino);
        });

        return redirect()->back()->with('success', 'Correo enviado correctamente.');
    }
}
