<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cobro extends Model
{
    use HasFactory;
    protected $fillable = [
        'pendiente_id', 'contrato_id', 'fechaCobro', 'cuota', 'monto'
    ];
    public function contrato(){
        return $this->belongsTo(Contrato::class);
    }
    public function cliente(){
        return $this->contrato->belongsTo(Cliente::class);
    }
}
