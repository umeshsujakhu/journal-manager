<?php

namespace App\Swagger;

use App\Swagger\PaginatedResource;

/**
* @OA\Schema(
*     title="JournalListResource",
*     description="Journal resource",
*     @OA\Xml(
*         name="JournalListResource"
*     )
* )
*/
class JournalListResource extends PaginatedResource
{
    /**
    * @OA\Property(
    *     title="Payload",
    *     description="Payload wrapper"
    * )
    *
    * @var  \App\Swagger\Models\Journal[]
    */
    private $payload;
}

