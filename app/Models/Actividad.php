<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Actividad extends Model
{
    use HasFactory;

    protected $table='actividades';
    protected $fillable=['nombre_actividad', 'id_categoria', 'descripcion', 'fecha_hora_inicio', 'fecha_hora_termino', 'id_usuario', 'recordatorio'];

    public $timestamps = false;

    public function categoria():BelongsTo{
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function usuario():BelongsTo{
        return $this->belongsTo(Usuario::class);
    }
}
