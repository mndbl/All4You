<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pendiente;

class Contrato extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha', 'cliente_id', 'monto', 'status'
    ];

    public function pendientes(){
        return $this->hasMany(Pendiente::class)->where('status', 'p');
    }
    public function items(){
        return $this->hasMany(Item::class);
    }
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
  

}
