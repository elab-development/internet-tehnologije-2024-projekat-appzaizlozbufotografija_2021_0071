<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FotografijaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'naziv' => $this->naziv,
            'opis' => $this->opis,
            'datum_kreiranja' => $this->datum_kreiranja,
            'tehnika' => $this->tehnika,
            'slika' => $this->slika ? asset('storage/' . $this->slika) : null,
            'izlozbe' => IzlozbaResource::collection($this->whenLoaded('izlozbe')),
            'korisnik' => new KorisnikResource($this->whenLoaded('korisnik')),
        ];
    }
}


