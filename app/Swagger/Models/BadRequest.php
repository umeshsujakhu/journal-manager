<?php


namespace App\Swagger\Models;

/**
 * @OA\Schema(
 *     title="BadRequest",
 *     description="BadRequest model",
 *     @OA\Xml(
 *         name="BadRequest"
 *     )
 * )
 */
class BadRequest
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
     *     example="400 Bad Reuest"
     * )
     *
     * @var string
     */
    protected $message;
}
