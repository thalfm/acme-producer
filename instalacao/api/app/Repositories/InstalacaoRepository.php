<?php

namespace App\Repositories;

use App\Models\Instalacao;
use App\Repositories\BaseRepository;

/**
 * Class InstalacaoRepository
 * @package App\Repositories
 * @version March 17, 2021, 2:46 pm UTC
*/

class InstalacaoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
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
        return Instalacao::class;
    }
}
