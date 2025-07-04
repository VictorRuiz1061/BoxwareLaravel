<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Permiso
 * 
 * Representa los permisos del sistema que controlan el acceso a módulos.
 * Cada permiso define qué acciones puede realizar un rol en un módulo específico.
 * 
 * @property int $id_permiso Identificador único del permiso
 * @property string $nombre Nombre del permiso
 * @property bool $estado Estado activo/inactivo del permiso
 * @property bool $puede_ver Permite ver el módulo
 * @property bool $puede_crear Permite crear registros
 * @property bool $puede_editar Permite editar registros
 * @property bool $puede_eliminar Permite eliminar registros
 * @property int $modulo_id ID del módulo al que aplica
 * @property int $rol_id ID del rol que tiene el permiso
 * @property \Carbon\Carbon $fecha_creacion Fecha de creación del permiso
 */
class Permiso extends Model
{
    /**
     * Clave primaria personalizada
     * 
     * @var string
     */
    protected $primaryKey = 'id_permiso';

    /**
     * Deshabilitar timestamps automáticos
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * Los atributos que son asignables masivamente.
     * 
     * @var array
     */
    protected $fillable = [
        'nombre',
        'estado',
        'puede_ver',
        'puede_crear',
        'puede_editar',
        'puede_eliminar',
        'modulo_id',
        'rol_id',
        'fecha_creacion',
    ];

    /**
     * Relación con Modulo
     * Un permiso está asociado a un módulo específico
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'modulo_id', 'id_modulo');
    }

    /**
     * Relación con Rol
     * Un permiso pertenece a un rol específico
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id', 'id_rol');
    }
}
