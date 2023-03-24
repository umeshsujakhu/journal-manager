<?php
namespace App\Swagger;
/**
 * @OA\Schema(
 *     title="PaginatedResource",
 *     description="PaginatedResource model",
 *     @OA\Xml(
 *         name="PaginatedResource"
 *     )
 * )
 */
class PaginatedResource
{
    /**
     * @OA\Property(
     *     title="status",
     *     description="status",
     *     format="string",
     *     example="ok"
     * )
     *
     * @var string
     */
    protected $status;

    /**
     * @OA\Property(
     *     title="message",
     *     description="message",
     *     format="string",
     *     example="Items listed successfully"
     * )
     *
     * @var string
     */
    protected $message;

    /**
     * @OA\Property(
     *     title="Payload",
     *     description="Payload wrapper"
     * )
     *
     * @var \App\Swagger\Models\Common\MetaData[]
     */
    protected $meta_data;
}
