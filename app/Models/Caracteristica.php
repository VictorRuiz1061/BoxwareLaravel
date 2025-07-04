<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Caracteristica
 * 
 * Representa las características de los materiales del inventario.
 * Cada característica describe una propiedad específica de los materiales.
 * 
 * @property int $id_caracteristica Identificador único de la característica
 * @property string $nombre_caracteristica Nombre de la característica
 * @property string $descripcion_caracteristica Descripción detallada de la característica
 * @property bool $estado Estado activo/inactivo de la característica
 * @property \Carbon\Carbon $fecha_creacion Fecha de creación de la característica
 * @property \Carbon\Carbon $fecha_modificacion Fecha de última modificación
 */
class Caracteristica extends Model
{
    /**
     * Clave primaria personalizada
     * 
     * @var string
     */
    protected $primaryKey = 'id_caracteristica';

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
        'nombre_caracteristica',
        'descripcion_caracteristica',
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id', 'id_material');
    }
}
