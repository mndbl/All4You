<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    use HasFactory;
    protected $fillable = [
        'contrato_id', 'fechaVenc', 'cuota', 'monto', 'status'
    ];
}
