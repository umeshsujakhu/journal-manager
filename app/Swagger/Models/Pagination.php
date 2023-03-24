<?php
namespace App\Swagger\Models;

/**
 * @OA\Schema(
 *     title="Pagination",
 *     description="Pagination model",
 *     @OA\Xml(
 *         name="Pagination"
 *     )
 * )
 */
class Pagination
{
    /**
     * @OA\Property(
     *     title="total",
     *     description="total",
     *     format="int64",
     *     example=100
     * )
     *
     * @var integer
     */
    private $total;

    /**
     * @OA\Property(
     *     title="per_page",
     *     description="per_page",
     *     format="int64",
     *     example=10
     * )
     *
     * @var integer
     */
    private $per_page;

    /**
     * @OA\Property(
     *     title="last_page",
     *     description="last_page",
     *     format="int64",
     *     example=10
     * )
     *
     * @var integer
     */
    private $last_page;

    /**
     * @OA\Property(
     *     title="current_page",
     *     description="current_page",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $current_page;

    /**
     * @OA\Property(
     *     title="current_page",
     *     description="current_page",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $from;

    /**
     * @OA\Property(
     *     title="to",
     *     description="to",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $to;

}
