<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Ficha
 * 
 * Representa las fichas de formación asignadas a usuarios.
 * Cada ficha vincula un usuario con un programa específico de formación.
 * 
 * @property int $id_ficha Identificador único de la ficha
 * @property bool $estado Estado activo/inactivo de la ficha
 * @property \Carbon\Carbon $fecha_creacion Fecha de creación del registro
 * @property \Carbon\Carbon $fecha_modificacion Fecha de última modificación
 * @property int $usuario_id ID del usuario asignado
 * @property int $programa_id ID del programa de formación
 */
class Ficha extends Model
{
    /**
     * Clave primaria personalizada
     * 
     * @var string
     */
    protected $primaryKey = 'id_ficha';

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
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
        'usuario_id',
        'programa_id',
    ];

    /**
     * Relación con Usuario
     * Una ficha pertenece a un usuario específico
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }

    /**
     * Relación con Programa
     * Una ficha está asociada a un programa de formación
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function programa()
    {
        return $this->belongsTo(Programa::class, 'programa_id', 'id_programa');
    }
}
