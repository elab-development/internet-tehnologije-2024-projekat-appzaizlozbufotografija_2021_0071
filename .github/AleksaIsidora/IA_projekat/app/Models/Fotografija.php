<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fotografija extends Model
{
    public function izlozba()
    {
        return $this->belongsTo(Izlozba::class);
    }
}
