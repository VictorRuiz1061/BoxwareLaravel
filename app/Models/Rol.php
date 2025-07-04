<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Rol
 * 
 * Representa los roles del sistema que definen los niveles de acceso.
 * Cada rol puede tener múltiples permisos y usuarios asignados.
 * 
 * @property int $id_rol Identificador único del rol
 * @property string $nombre_rol Nombre del rol
 * @property string $descripcion Descripción del rol
 * @property bool $estado Estado activo/inactivo del rol
 * @property \Carbon\Carbon $fecha_creacion Fecha de creación del rol
 * @property \Carbon\Carbon $fecha_modificacion Fecha de última modificación
 */
class Rol extends Model
{
    use HasFactory;

    /**
     * Clave primaria personalizada
     * 
     * @var string
     */
    protected $table = 'roles';
    protected $primaryKey = 'id_rol';
    public $timestamps = false;

    /**
     * Los atributos que son asignables masivamente.
     * 
     * @var array
     */
    protected $fillable = [
        'nombre_rol',
        'descripcion',
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
    ];

    /**
     * Relación con Usuarios
     * Un rol puede tener múltiples usuarios asignados
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'rol_id', 'id_rol');
    }

    /**
     * Relación con Permisos
     * Un rol puede tener múltiples permisos
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permisos()
    {
        return $this->hasMany(Permiso::class, 'rol_id', 'id_rol');
    }
} 