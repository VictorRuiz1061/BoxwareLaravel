<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Sitio
 * 
 * Representa las ubicaciones físicas donde se almacenan los materiales.
 * Cada sitio tiene un tipo específico y puede contener múltiples elementos
 * del inventario.
 * 
 * @property int $id_sitio Identificador único del sitio
 * @property string $nombre_sitio Nombre del sitio de almacenamiento
 * @property string $ubicacion Ubicación física del sitio
 * @property string $ficha_tecnica Ficha técnica del sitio
 * @property bool $estado Estado activo/inactivo del sitio
 * @property int $tipo_sitio_id ID del tipo de sitio
 * @property \Carbon\Carbon $fecha_creacion Fecha de creación del registro
 * @property \Carbon\Carbon $fecha_modificacion Fecha de última modificación
 */
class Sitio extends Model
{
    /**
     * Clave primaria personalizada
     * 
     * @var string
     */
    protected $primaryKey = 'id_sitio';

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
        'nombre_sitio',
        'ubicacion',
        'ficha_tecnica',
        'estado',
        'tipo_sitio_id',
        'fecha_creacion',
        'fecha_modificacion',
    ];

    /**
     * Relación con TipoSitio
     * Un sitio pertenece a un tipo específico
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoSitio()
    {
        return $this->belongsTo(TipoSitio::class, 'tipo_sitio_id', 'id_tipo_sitio');
    }

    /**
     * Relación con Inventario
     * Un sitio puede tener múltiples registros de inventario
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventarios()
    {
        return $this->hasMany(Inventario::class, 'sitio_id', 'id_sitio');
    }
}
