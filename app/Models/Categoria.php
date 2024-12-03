<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    use HasFactory;

    protected $table='categorias';
    public $timestamps = false;
    
    protected $fillable = [
        'id_usuario',
        'nombre_categoria',
        'color',
    ];
    public function actividades():HasMany{
        return $this->hasMany(Actividad::class, 'id_categoria');
    }
}
