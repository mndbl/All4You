<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable=[
        'nic', 'nombre', 'email', 'telefono', 'canal', 'pais', 'representante'
    ];

    public function contratos(){
        return $this->hasMany(Contratos::class);
    }
    public function pendientes(){
        return $this->hasManyThrough(Pendientes::class, Contratos::class);
    }
}
