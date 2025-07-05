<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Modelo Usuario
 * 
 * Representa los usuarios del sistema de bodega del SENA.
 * Extiende de Authenticatable para manejar la autenticación.
 * Cada usuario tiene un rol específico que determina sus permisos.
 * 
 * @property int $id_usuario Identificador único del usuario
 * @property string $nombre Nombre del usuario
 * @property string $apellido Apellido del usuario
 * @property string $email Correo electrónico único del usuario
 * @property string $password Contraseña hasheada del usuario
 * @property bool $estado Estado activo/inactivo del usuario
 * @property string|null $remember_token Token para "recordar sesión"
 * @property int $rol_id ID del rol asignado al usuario
 */
class Usuario extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * Clave primaria personalizada
     * 
     * @var string
     */
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = true;

    /**
     * Los atributos que son asignables masivamente.
     * 
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'edad',
        'cedula',
        'email',
        'password',
        'telefono',
        'imagen',
        'estado',
        'fecha_registro',
        'rol_id',
    ];
    
    /**
     * Los atributos que deben estar ocultos para arrays.
     * 
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relación con Rol
     * Un usuario pertenece a un rol
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id', 'id_rol');
    }

    /**
     * Relación con Fichas
     * Un usuario puede tener múltiples fichas de formación
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fichas()
    {
        return $this->hasMany(Ficha::class, 'usuario_id', 'id_usuario');
    }
}