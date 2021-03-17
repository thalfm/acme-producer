<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Endereco",
 *      required={"cidade", "bairro", "estado", "cep"},
 *      @SWG\Property(
 *          property="idEndereco",
 *          description="idEndereco",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="cidade",
 *          description="cidade",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="bairro",
 *          description="bairro",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="estado",
 *          description="estado",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="cep",
 *          description="cep",
 *          type="string"
 *      )
 * )
 */
class Endereco extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'Endereco';
    public $timestamps = false;
    public $fillable = [
        'idEndereco',
        'cidade',
        'bairro',
        'estado',
        'cep'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'idEndereco' => 'integer',
        'cidade' => 'string',
        'bairro' => 'string',
        'estado' => 'string',
        'cep' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cidade' => 'required|string|max:100',
        'bairro' => 'required|string|max:45',
        'estado' => 'required|string|max:45',
        'cep' => 'required|string|max:8'
    ];


}
