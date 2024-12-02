<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table='usuarios';
    protected $hidden = ['password'];
    public $timestamps = false;


    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function pagos():HasMany{
        return $this->hasMany(Pago::class);
    }

    public function actividades():HasMany{
        return $this->hasMany(Actividad::class);
    }

    public function fondo():BelongsTo{
        return $this->belongsTo(Fondo::class);
    }

}
