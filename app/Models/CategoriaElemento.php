<?php

// app/Models/CategoriaElemento.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo CategoriaElemento
 * 
 * Representa las categorías de elementos que clasifican los materiales.
 * Cada categoría agrupa materiales con características similares.
 * 
 * @property int $id_categoria_elemento Identificador único de la categoría
 * @property string $nombre_categoria Nombre de la categoría
 * @property string $descripcion_categoria Descripción detallada de la categoría
 * @property bool $estado Estado activo/inactivo de la categoría
 * @property \Carbon\Carbon $fecha_creacion Fecha de creación de la categoría
 * @property \Carbon\Carbon $fecha_modificacion Fecha de última modificación
 */
class CategoriaElemento extends Model
{
    /**
     * Clave primaria personalizada
     * 
     * @var string
     */
    protected $primaryKey = 'id_categoria_elemento';

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
        'nombre_categoria',
        'descripcion_categoria',
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
    ];

    /**
     * Relación con Materiales
     * Una categoría puede tener múltiples materiales
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function materiales()
    {
        return $this->hasMany(Material::class, 'categoria_id', 'id_categoria_elemento');
    }
}
