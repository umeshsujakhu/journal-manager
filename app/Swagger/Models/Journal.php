<?php

namespace App\Swagger\Models;

use App\Swagger\Models\BaseModel;

/**
 * @OA\Schema(
 *     title="Journals",
 *     description="Journal model",
 *     @OA\Xml(
 *         name="Journals"
 *     )
 * )
 */

class Journal extends BaseModel
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
