<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $fillable=[
        'tipo',
        'descripcion',
        'precio'
    ];
    
    public function scopeDatosServicios($query, $servicio_id){
        return $query->where('id', $servicio_id);
    }
}
