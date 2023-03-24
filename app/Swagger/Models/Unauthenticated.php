<?php
namespace App\Swagger\Models;

/**
 * @OA\Schema(
 *     title="Unauthenticated",
 *     description="Unauthenticated model",
 *     @OA\Xml(
 *         name="Unauthenticated"
 *     )
 * )
 */
class Unauthenticated
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
     *     example="You are not logged in. Please login first."
     * )
     *
     * @var string
     */
    protected $message;

}
