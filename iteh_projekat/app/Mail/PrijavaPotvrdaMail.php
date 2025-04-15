<?php 

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PrijavaPotvrdaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $imeIzlozbe;
    public $qr;

    public function __construct($imeIzlozbe, $qrText)
    {
        $this->imeIzlozbe = $imeIzlozbe;

        // ✅ Prvo konvertujemo tekst u UTF-8 ručno (ako već nije)
        $utfText = mb_convert_encoding($qrText, 'UTF-8');

        // ✅ Formatiramo kao SVG i generišemo
        $this->qr = base64_encode(
            QrCode::format('svg')
                ->encoding('UTF-8') // << OVO JE KLJUČ
                ->size(200)
                ->generate($utfText)
        );
    }

    public function build()
    {
        return $this->subject('Potvrda prijave na izložbu')
                    ->view('emails.potvrda')
                    ->with([
                        'imeIzlozbe' => $this->imeIzlozbe,
                        'qr' => $this->qr,
                    ]);
    }
}




