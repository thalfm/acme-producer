<?php

namespace App\Repositories;

use App\Models\Fatura;
use App\Repositories\BaseRepository;

/**
 * Class FaturaRepository
 * @package App\Repositories
 * @version March 17, 2021, 2:37 pm UTC
*/

class FaturaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cpf',
        'dataVencimento',
        'dataLeitura',
        'valorLeitura',
        'valorConta',
        'idEndereco'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Fatura::class;
    }
}
