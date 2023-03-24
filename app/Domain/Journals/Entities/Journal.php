<?php
namespace App\Domain\Journals\Entities;

use App\Core\Entities\BaseModel;
/**
 * Class Journal
 * @package App\Domain\Journals\Entities
 */
class Journal extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = ['title', 'date', 'body'];

}
