<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Fatura",
 *      required={"cpf", "dataVencimento", "dataLeitura", "valorLeitura", "valorConta", "idEndereco"},
 *      @SWG\Property(
 *          property="idFatura",
 *          description="idFatura",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="cpf",
 *          description="cpf",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="dataVencimento",
 *          description="dataVencimento",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="dataLeitura",
 *          description="dataLeitura",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="valorLeitura",
 *          description="valorLeitura",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="valorConta",
 *          description="valorConta",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="idEndereco",
 *          description="idEndereco",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Fatura extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Fatura';
    public $timestamps = false;
    public $fillable = [
        'idFatura',
        'cpf',
        'dataVencimento',
        'dataLeitura',
        'valorLeitura',
        'valorConta',
        'idEndereco'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'idFatura' => 'integer',
        'cpf' => 'string',
        'dataVencimento' => 'date',
        'dataLeitura' => 'date',
        'valorLeitura' => 'decimal:2',
        'valorConta' => 'decimal:2',
        'idEndereco' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cpf' => 'required|string|max:11',
        'dataVencimento' => 'required',
        'dataLeitura' => 'required',
        'valorLeitura' => 'required|numeric',
        'valorConta' => 'required|numeric',
        'idEndereco' => 'required|integer'
    ];


}
