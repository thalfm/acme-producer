<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEnderecoAPIRequest;
use App\Http\Requests\API\UpdateEnderecoAPIRequest;
use App\Models\Endereco;
use App\Repositories\EnderecoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EnderecoController
 * @package App\Http\Controllers\API
 */

class EnderecoAPIController extends AppBaseController
{
    /** @var  EnderecoRepository */
    private $enderecoRepository;

    public function __construct(EnderecoRepository $enderecoRepo)
    {
        $this->enderecoRepository = $enderecoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/enderecos",
     *      summary="Get a listing of the Enderecos.",
     *      tags={"Endereco"},
     *      description="Get all Enderecos",
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
     *                  @SWG\Items(ref="#/definitions/Endereco")
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
        $enderecos = $this->enderecoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($enderecos->toArray(), 'Enderecos retrieved successfully');
    }

    /**
     * @param CreateEnderecoAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/enderecos",
     *      summary="Store a newly created Endereco in storage",
     *      tags={"Endereco"},
     *      description="Store Endereco",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Endereco that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Endereco")
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
     *                  ref="#/definitions/Endereco"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateEnderecoAPIRequest $request)
    {
        $input = $request->all();

        $endereco = $this->enderecoRepository->create($input);

        return $this->sendResponse($endereco->toArray(), 'Endereco saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/enderecos/{id}",
     *      summary="Display the specified Endereco",
     *      tags={"Endereco"},
     *      description="Get Endereco",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Endereco",
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
     *                  ref="#/definitions/Endereco"
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
        /** @var Endereco $endereco */
        $endereco = $this->enderecoRepository->find($id);

        if (empty($endereco)) {
            return $this->sendError('Endereco not found');
        }

        return $this->sendResponse($endereco->toArray(), 'Endereco retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateEnderecoAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/enderecos/{id}",
     *      summary="Update the specified Endereco in storage",
     *      tags={"Endereco"},
     *      description="Update Endereco",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Endereco",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Endereco that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Endereco")
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
     *                  ref="#/definitions/Endereco"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateEnderecoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Endereco $endereco */
        $endereco = $this->enderecoRepository->find($id);

        if (empty($endereco)) {
            return $this->sendError('Endereco not found');
        }

        $endereco = $this->enderecoRepository->update($input, $id);

        return $this->sendResponse($endereco->toArray(), 'Endereco updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/enderecos/{id}",
     *      summary="Remove the specified Endereco from storage",
     *      tags={"Endereco"},
     *      description="Delete Endereco",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Endereco",
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
        /** @var Endereco $endereco */
        $endereco = $this->enderecoRepository->find($id);

        if (empty($endereco)) {
            return $this->sendError('Endereco not found');
        }

        $endereco->delete();

        return $this->sendSuccess('Endereco deleted successfully');
    }
}
