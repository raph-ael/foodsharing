<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStoreCategoryAPIRequest;
use App\Http\Requests\API\UpdateStoreCategoryAPIRequest;
use App\Models\StoreCategory;
use App\Repositories\StoreCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class StoreCategoryController
 * @package App\Http\Controllers\API
 */

class StoreCategoryAPIController extends AppBaseController
{
    /** @var  StoreCategoryRepository */
    private $storeCategoryRepository;

    public function __construct(StoreCategoryRepository $storeCategoryRepo)
    {
        $this->storeCategoryRepository = $storeCategoryRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/storeCategories",
     *      summary="Get a listing of the StoreCategories.",
     *      tags={"StoreCategory"},
     *      description="Get all StoreCategories",
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
     *                  @SWG\Items(ref="#/definitions/StoreCategory")
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
        $this->storeCategoryRepository->pushCriteria(new RequestCriteria($request));
        $this->storeCategoryRepository->pushCriteria(new LimitOffsetCriteria($request));
        $storeCategories = $this->storeCategoryRepository->all();

        return $this->sendResponse($storeCategories->toArray(), 'Store Categories retrieved successfully');
    }

    /**
     * @param CreateStoreCategoryAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/storeCategories",
     *      summary="Store a newly created StoreCategory in storage",
     *      tags={"StoreCategory"},
     *      description="Store StoreCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StoreCategory that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StoreCategory")
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
     *                  ref="#/definitions/StoreCategory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStoreCategoryAPIRequest $request)
    {
        $input = $request->all();

        $storeCategories = $this->storeCategoryRepository->create($input);

        return $this->sendResponse($storeCategories->toArray(), 'Store Category saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/storeCategories/{id}",
     *      summary="Display the specified StoreCategory",
     *      tags={"StoreCategory"},
     *      description="Get StoreCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StoreCategory",
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
     *                  ref="#/definitions/StoreCategory"
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
        /** @var StoreCategory $storeCategory */
        $storeCategory = $this->storeCategoryRepository->findWithoutFail($id);

        if (empty($storeCategory)) {
            return $this->sendError('Store Category not found');
        }

        return $this->sendResponse($storeCategory->toArray(), 'Store Category retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStoreCategoryAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/storeCategories/{id}",
     *      summary="Update the specified StoreCategory in storage",
     *      tags={"StoreCategory"},
     *      description="Update StoreCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StoreCategory",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StoreCategory that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StoreCategory")
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
     *                  ref="#/definitions/StoreCategory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStoreCategoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var StoreCategory $storeCategory */
        $storeCategory = $this->storeCategoryRepository->findWithoutFail($id);

        if (empty($storeCategory)) {
            return $this->sendError('Store Category not found');
        }

        $storeCategory = $this->storeCategoryRepository->update($input, $id);

        return $this->sendResponse($storeCategory->toArray(), 'StoreCategory updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/storeCategories/{id}",
     *      summary="Remove the specified StoreCategory from storage",
     *      tags={"StoreCategory"},
     *      description="Delete StoreCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StoreCategory",
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
        /** @var StoreCategory $storeCategory */
        $storeCategory = $this->storeCategoryRepository->findWithoutFail($id);

        if (empty($storeCategory)) {
            return $this->sendError('Store Category not found');
        }

        $storeCategory->delete();

        return $this->sendResponse($id, 'Store Category deleted successfully');
    }
}
