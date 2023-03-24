<?php
namespace App\Swagger\Models;

/**
 * @OA\Schema(
 *     title="NotFound",
 *     description="NotFound model",
 *     @OA\Xml(
 *         name="NotFound"
 *     )
 * )
 */
class NotFound
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
     *     example="404 Page not found"
     * )
     *
     * @var string
     */
    protected $message;
}
