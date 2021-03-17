<?php

namespace App\Repositories;

use App\Models\Endereco;
use App\Repositories\BaseRepository;

/**
 * Class EnderecoRepository
 * @package App\Repositories
 * @version March 17, 2021, 2:37 pm UTC
*/

class EnderecoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cidade',
        'bairro',
        'estado',
        'cep'
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
        return Endereco::class;
    }
}
