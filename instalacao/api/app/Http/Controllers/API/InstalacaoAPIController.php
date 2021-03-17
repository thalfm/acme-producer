<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInstalacaoAPIRequest;
use App\Http\Requests\API\UpdateInstalacaoAPIRequest;
use App\Models\Instalacao;
use App\Repositories\InstalacaoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class InstalacaoController
 * @package App\Http\Controllers\API
 */

class InstalacaoAPIController extends AppBaseController
{
    /** @var  InstalacaoRepository */
    private $instalacaoRepository;

    public function __construct(InstalacaoRepository $instalacaoRepo)
    {
        $this->instalacaoRepository = $instalacaoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/instalacaos",
     *      summary="Get a listing of the Instalacaos.",
     *      tags={"Instalacao"},
     *      description="Get all Instalacaos",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Instalacao")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $instalacaos = $this->instalacaoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($instalacaos->toArray(), 'Instalacaos retrieved successfully');
    }

    /**
     * @param CreateInstalacaoAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/instalacaos",
     *      summary="Store a newly created Instalacao in storage",
     *      tags={"Instalacao"},
     *      description="Store Instalacao",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Instalacao that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Instalacao")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Instalacao"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateInstalacaoAPIRequest $request)
    {
        $input = $request->all();

        $instalacao = $this->instalacaoRepository->create($input);

        return $this->sendResponse($instalacao->toArray(), 'Instalacao saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/instalacaos/{id}",
     *      summary="Display the specified Instalacao",
     *      tags={"Instalacao"},
     *      description="Get Instalacao",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Instalacao",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Instalacao"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Instalacao $instalacao */
        $instalacao = $this->instalacaoRepository->find($id);

        if (empty($instalacao)) {
            return $this->sendError('Instalacao not found');
        }

        return $this->sendResponse($instalacao->toArray(), 'Instalacao retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateInstalacaoAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/instalacaos/{id}",
     *      summary="Update the specified Instalacao in storage",
     *      tags={"Instalacao"},
     *      description="Update Instalacao",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Instalacao",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Instalacao that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Instalacao")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Instalacao"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateInstalacaoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Instalacao $instalacao */
        $instalacao = $this->instalacaoRepository->find($id);

        if (empty($instalacao)) {
            return $this->sendError('Instalacao not found');
        }

        $instalacao = $this->instalacaoRepository->update($input, $id);

        return $this->sendResponse($instalacao->toArray(), 'Instalacao updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/instalacaos/{id}",
     *      summary="Remove the specified Instalacao from storage",
     *      tags={"Instalacao"},
     *      description="Delete Instalacao",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Instalacao",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Instalacao $instalacao */
        $instalacao = $this->instalacaoRepository->find($id);

        if (empty($instalacao)) {
            return $this->sendError('Instalacao not found');
        }

        $instalacao->delete();

        return $this->sendSuccess('Instalacao deleted successfully');
    }
}
