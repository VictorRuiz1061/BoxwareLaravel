<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo TipoSitio
 * 
 * Representa los tipos de sitios de almacenamiento.
 * Cada tipo define la función específica de un sitio de almacenamiento.
 * 
 * @property int $id_tipo_sitio Identificador único del tipo de sitio
 * @property string $nombre_tipo_sitio Nombre del tipo de sitio
 * @property bool $estado Estado activo/inactivo del tipo
 * @property \Carbon\Carbon $fecha_creacion Fecha de creación del tipo
 * @property \Carbon\Carbon $fecha_modificacion Fecha de última modificación
 */
class TipoSitio extends Model
{
    /**
     * Clave primaria personalizada
     * 
     * @var string
     */
    protected $primaryKey = 'id_tipo_sitio';

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
        'nombre_tipo_sitio',
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
    ];

    /**
     * Relación con Sitios
     * Un tipo de sitio puede tener múltiples sitios
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sitios()
    {
        return $this->hasMany(Sitio::class, 'tipo_sitio_id', 'id_tipo_sitio');
    }
}
