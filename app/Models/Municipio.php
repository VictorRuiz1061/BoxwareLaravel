<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Municipio
 * 
 * Representa los municipios donde se ubican los centros del SENA.
 * Cada municipio puede tener múltiples centros.
 * 
 * @property int $id_municipio Identificador único del municipio
 * @property string $nombre_municipio Nombre del municipio
 * @property bool $estado Estado activo/inactivo del municipio
 * @property \Carbon\Carbon $fecha_creacion Fecha de creación del municipio
 * @property \Carbon\Carbon $fecha_modificacion Fecha de última modificación
 */
class Municipio extends Model
{
    /**
     * Clave primaria personalizada
     * 
     * @var string
     */
    protected $primaryKey = 'id_municipio';

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
        'nombre_municipio',
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
    ];

    /**
     * Relación con Centros
     * Un municipio puede tener múltiples centros del SENA
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function centros()
    {
        return $this->hasMany(Centro::class, 'municipio_id', 'id_municipio');
    }
}
