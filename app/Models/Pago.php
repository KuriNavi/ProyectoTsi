<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pago extends Model
{
    use HasFactory;

    protected $table='pagos';
    public $timestamps = false;
    
    public function usuario():BelongsTo{
        return $this->belongsTo(Usuario::class);
    }
}
