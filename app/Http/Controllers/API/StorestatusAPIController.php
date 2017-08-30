<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStorestatusAPIRequest;
use App\Http\Requests\API\UpdateStorestatusAPIRequest;
use App\Models\Storestatus;
use App\Repositories\StorestatusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class StorestatusController
 * @package App\Http\Controllers\API
 */

class StorestatusAPIController extends AppBaseController
{
    /** @var  StorestatusRepository */
    private $storestatusRepository;

    public function __construct(StorestatusRepository $storestatusRepo)
    {
        $this->storestatusRepository = $storestatusRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/storestatuses",
     *      summary="Get a listing of the Storestatuses.",
     *      tags={"Storestatus"},
     *      description="Get all Storestatuses",
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
     *                  @SWG\Items(ref="#/definitions/Storestatus")
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
        $this->storestatusRepository->pushCriteria(new RequestCriteria($request));
        $this->storestatusRepository->pushCriteria(new LimitOffsetCriteria($request));
        $storestatuses = $this->storestatusRepository->all();

        return $this->sendResponse($storestatuses->toArray(), 'Storestatuses retrieved successfully');
    }

    /**
     * @param CreateStorestatusAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/storestatuses",
     *      summary="Store a newly created Storestatus in storage",
     *      tags={"Storestatus"},
     *      description="Store Storestatus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Storestatus that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Storestatus")
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
     *                  ref="#/definitions/Storestatus"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStorestatusAPIRequest $request)
    {
        $input = $request->all();

        $storestatuses = $this->storestatusRepository->create($input);

        return $this->sendResponse($storestatuses->toArray(), 'Storestatus saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/storestatuses/{id}",
     *      summary="Display the specified Storestatus",
     *      tags={"Storestatus"},
     *      description="Get Storestatus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Storestatus",
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
     *                  ref="#/definitions/Storestatus"
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
        /** @var Storestatus $storestatus */
        $storestatus = $this->storestatusRepository->findWithoutFail($id);

        if (empty($storestatus)) {
            return $this->sendError('Storestatus not found');
        }

        return $this->sendResponse($storestatus->toArray(), 'Storestatus retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStorestatusAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/storestatuses/{id}",
     *      summary="Update the specified Storestatus in storage",
     *      tags={"Storestatus"},
     *      description="Update Storestatus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Storestatus",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Storestatus that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Storestatus")
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
     *                  ref="#/definitions/Storestatus"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStorestatusAPIRequest $request)
    {
        $input = $request->all();

        /** @var Storestatus $storestatus */
        $storestatus = $this->storestatusRepository->findWithoutFail($id);

        if (empty($storestatus)) {
            return $this->sendError('Storestatus not found');
        }

        $storestatus = $this->storestatusRepository->update($input, $id);

        return $this->sendResponse($storestatus->toArray(), 'Storestatus updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/storestatuses/{id}",
     *      summary="Remove the specified Storestatus from storage",
     *      tags={"Storestatus"},
     *      description="Delete Storestatus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Storestatus",
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
        /** @var Storestatus $storestatus */
        $storestatus = $this->storestatusRepository->findWithoutFail($id);

        if (empty($storestatus)) {
            return $this->sendError('Storestatus not found');
        }

        $storestatus->delete();

        return $this->sendResponse($id, 'Storestatus deleted successfully');
    }
}
