<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Cliente",
 *      required={"cpf", "nome", "dataNascimento", "idEndereco"},
 *      @SWG\Property(
 *          property="idCliente",
 *          description="idCliente",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="cpf",
 *          description="cpf",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="nome",
 *          description="nome",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="dataNascimento",
 *          description="dataNascimento",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="idEndereco",
 *          description="idEndereco",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Cliente extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'Cliente';
    public $timestamps = false;
    public $fillable = [
        'idCliente',
        'cpf',
        'nome',
        'dataNascimento',
        'idEndereco'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'idCliente' => 'integer',
        'cpf' => 'string',
        'nome' => 'string',
        'dataNascimento' => 'date',
        'idEndereco' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cpf' => 'required|string|max:11',
        'nome' => 'required|string|max:200',
        'dataNascimento' => 'required',
        'idEndereco' => 'required|integer'
    ];


}
