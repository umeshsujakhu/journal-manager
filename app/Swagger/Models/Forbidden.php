<?php

namespace App\Swagger\Models;

/**
 * @OA\Schema(
 *     title="Forbidden",
 *     description="Forbidden model",
 *     @OA\Xml(
 *         name="Forbidden"
 *     )
 * )
 */
class Forbidden
{
    /**
     * @OA\Property(
     *     title="status",
     *     description="status",
     *     format="string",
     *     example="err"
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
     *     example="Either this content doesnot exists or you do not have enough priviledges"
     * )
     *
     * @var string
     */
    protected $message;

}
