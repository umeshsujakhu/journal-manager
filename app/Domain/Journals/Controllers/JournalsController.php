<?php

namespace App\Domain\Journals\Controllers;

use App\Domain\Journals\Interfaces\JournalInterface;
use App\Domain\Journals\Requests\JournalCreateRequest;
use App\Domain\Journals\Requests\JournalRequest;
use App\Core\Controllers\BaseController;

/**
 * Class JournalsController
 * @package App\Domain\Journals\Controllers
 */
class JournalsController extends BaseController {

     /**
     * @var JournalInterface
     */
     protected $repository;

    /**
     * JournalsController constructor.
     *
     * @param JournalInterface $repository
     */
    public function __construct(JournalInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @OA\Get(
     *      path="/api/journals",
     *      operationId="api/journals",
     *      tags={"Journals"},
     *      summary="Get Journals",
     *      description="Returns Journals list",
     *       @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Current page"
     *      ),
     *       @OA\Parameter(
     *         name="page_size",
     *         in="query",
     *         description="Page Size"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/JournalListResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/NotFound")
     *      ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(ref="#/components/schemas/Unauthenticated")
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent(ref="#/components/schemas/Forbidden")
     *      )
     * )
     */

    /**
     * @param JournalRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(JournalRequest $request){
        return $this->responsePaginate($this->repository->getPaginatedList($request));
    }

    /**
     * @OA\Post(
     *      path="/api/journals",
     *      operationId="api/journals",
     *      tags={"Journals"},
     *      summary="Store new journal entry",
     *      description="Returns journal",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/JournalCreateRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *                @OA\Property(
     *                  property="status",
     *                  type="string",
     *                  description="status"
     *                ),
     *                @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Item Created successfully"
     *                ),
     *                @OA\Property(
     *                  property="payload",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/Journal")
     *                )
     *              )
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/NotFound")
     *      ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(ref="#/components/schemas/Unauthenticated")
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent(ref="#/components/schemas/Forbidden")
     *      )
     * )
     */

    /**
     * @param JournalCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(JournalCreateRequest $request){
        return $this->responseCreated($this->repository->create($request->all()));
    }

    /**
     * @param JournalRequest $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(JournalRequest $request,$id){
        return $this->responseOk($this->repository->getById($id));
    }

}
