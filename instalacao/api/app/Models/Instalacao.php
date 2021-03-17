<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Instalacao",
 *      required={"nome", "idEndereco"},
 *      @SWG\Property(
 *          property="idInstalacao",
 *          description="idInstalacao",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="nome",
 *          description="nome",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="idEndereco",
 *          description="idEndereco",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Instalacao extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Instalacao';
    public $timestamps = false;
    public $fillable = [
        'idInstalacao',
        'nome',
        'idEndereco'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'idInstalacao' => 'integer',
        'nome' => 'string',
        'idEndereco' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nome' => 'required|string|max:200',
        'idEndereco' => 'required|integer'
    ];


}
