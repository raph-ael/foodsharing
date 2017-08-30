<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateConversationAPIRequest;
use App\Http\Requests\API\UpdateConversationAPIRequest;
use App\Models\Conversation;
use App\Repositories\ConversationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ConversationController
 * @package App\Http\Controllers\API
 */

class ConversationAPIController extends AppBaseController
{
    /** @var  ConversationRepository */
    private $conversationRepository;

    public function __construct(ConversationRepository $conversationRepo)
    {
        $this->conversationRepository = $conversationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/conversations",
     *      summary="Get a listing of the Conversations.",
     *      tags={"Conversation"},
     *      description="Get all Conversations",
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
     *                  @SWG\Items(ref="#/definitions/Conversation")
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
        $this->conversationRepository->pushCriteria(new RequestCriteria($request));
        $this->conversationRepository->pushCriteria(new LimitOffsetCriteria($request));
        $conversations = $this->conversationRepository->all();

        return $this->sendResponse($conversations->toArray(), 'Conversations retrieved successfully');
    }


    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/conversations/{id}",
     *      summary="Display the specified Conversation",
     *      tags={"Conversation"},
     *      description="Get Conversation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Conversation",
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
     *                  ref="#/definitions/Conversation"
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
        /** @var Conversation $conversation */
        $conversation = $this->conversationRepository->findWithoutFail($id);

        if (empty($conversation)) {
            return $this->sendError('Conversation not found');
        }

        return $this->sendResponse($conversation->toArray(), 'Conversation retrieved successfully');
    }
}
