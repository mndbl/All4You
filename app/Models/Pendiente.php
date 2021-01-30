<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendiente extends Model
{
    use HasFactory;
    protected $fillable = [
        'contrato_id', 'fechaVenc', 'cuota', 'monto', 'status'
    ];
    
    public function contrato(){
        return $this->belongsTo(Contrato::class);
    }

    public function cliente(){
        return $this->contrato->belongsTo(Cliente::class);
    }
}
