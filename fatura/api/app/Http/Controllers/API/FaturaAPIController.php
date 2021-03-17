<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFaturaAPIRequest;
use App\Http\Requests\API\UpdateFaturaAPIRequest;
use App\Models\Fatura;
use App\Repositories\FaturaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class FaturaController
 * @package App\Http\Controllers\API
 */

class FaturaAPIController extends AppBaseController
{
    /** @var  FaturaRepository */
    private $faturaRepository;

    public function __construct(FaturaRepository $faturaRepo)
    {
        $this->faturaRepository = $faturaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/faturas",
     *      summary="Get a listing of the Faturas.",
     *      tags={"Fatura"},
     *      description="Get all Faturas",
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
     *                  @SWG\Items(ref="#/definitions/Fatura")
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
        $faturas = $this->faturaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($faturas->toArray(), 'Faturas retrieved successfully');
    }

    /**
     * @param CreateFaturaAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/faturas",
     *      summary="Store a newly created Fatura in storage",
     *      tags={"Fatura"},
     *      description="Store Fatura",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Fatura that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Fatura")
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
     *                  ref="#/definitions/Fatura"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateFaturaAPIRequest $request)
    {
        $input = $request->all();

        $fatura = $this->faturaRepository->create($input);

        return $this->sendResponse($fatura->toArray(), 'Fatura saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/faturas/{id}",
     *      summary="Display the specified Fatura",
     *      tags={"Fatura"},
     *      description="Get Fatura",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Fatura",
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
     *                  ref="#/definitions/Fatura"
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
        /** @var Fatura $fatura */
        $fatura = $this->faturaRepository->find($id);

        if (empty($fatura)) {
            return $this->sendError('Fatura not found');
        }

        return $this->sendResponse($fatura->toArray(), 'Fatura retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateFaturaAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/faturas/{id}",
     *      summary="Update the specified Fatura in storage",
     *      tags={"Fatura"},
     *      description="Update Fatura",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Fatura",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Fatura that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Fatura")
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
     *                  ref="#/definitions/Fatura"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateFaturaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Fatura $fatura */
        $fatura = $this->faturaRepository->find($id);

        if (empty($fatura)) {
            return $this->sendError('Fatura not found');
        }

        $fatura = $this->faturaRepository->update($input, $id);

        return $this->sendResponse($fatura->toArray(), 'Fatura updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/faturas/{id}",
     *      summary="Remove the specified Fatura from storage",
     *      tags={"Fatura"},
     *      description="Delete Fatura",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Fatura",
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
        /** @var Fatura $fatura */
        $fatura = $this->faturaRepository->find($id);

        if (empty($fatura)) {
            return $this->sendError('Fatura not found');
        }

        $fatura->delete();

        return $this->sendSuccess('Fatura deleted successfully');
    }
}
