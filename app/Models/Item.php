<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'contrato_id', 'servicio', 'intercambio','cuotas', 'monto', 'tipoContrato'
    ];

    public function contrato(){
        return $this->belongsTo(Contrato::class);
    }
    

}
