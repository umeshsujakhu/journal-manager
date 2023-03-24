<?php

namespace App\Swagger;

/**
 * @OA\Schema(
 *     title="Journal Create Request",
 *     description="Journal create request",
 *     @OA\Xml(
 *         name="Journals"
 *     )
 * )
 */

class JournalCreateRequest
{
    /**
     * @OA\Property(
     *     title="title",
     *     description="title",
     *     format="string",
     *     example="Title"
     * )
     *
     * @var  string
     */
    private $title;

    /**
     * @OA\Property(
     *      title="date",
     *      description="Date",
     *      example="2021-01-01"
     * )
     *
     * @var  string
     */
    public $date;

    /**
     * @OA\Property(
     *     title="body",
     *     description="body",
     *     format="string",
     * )
     *
     * @var  string
     */
    private $body;
}
