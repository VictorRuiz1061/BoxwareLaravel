<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Modulo
 * 
 * Representa los módulos funcionales del sistema.
 * Cada módulo tiene rutas específicas y puede ser un submenú de otro módulo.
 * 
 * @property int $id_modulo Identificador único del módulo
 * @property string $rutas Rutas asociadas al módulo
 * @property string $descripcion_ruta Descripción de la ruta
 * @property string $mensaje_cambio Mensaje de cambio del módulo
 * @property string $imagen Ruta de la imagen del módulo
 * @property bool $estado Estado activo/inactivo del módulo
 * @property bool $es_submenu Indica si es un submenú
 * @property int|null $modulo_padre_id ID del módulo padre (si es submenú)
 * @property \Carbon\Carbon|null $fecha_creacion Fecha de creación
 * @property \Carbon\Carbon|null $fecha_accion Fecha de última acción
 */
class Modulo extends Model
{
    /**
     * Clave primaria personalizada
     * 
     * @var string
     */
    protected $primaryKey = 'id_modulo';

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
        'rutas',
        'descripcion_ruta',
        'mensaje_cambio',
        'imagen',
        'estado',
        'es_submenu',
        'modulo_padre_id',
        'fecha_creacion',
        'fecha_accion',
    ];

    /**
     * Relación con Permisos
     * Un módulo puede tener múltiples permisos
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permisos()
    {
        return $this->hasMany(Permiso::class, 'modulo_id', 'id_modulo');
    }
}
