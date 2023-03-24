<?php
namespace App\Domain\Journals\Entities;

use App\Core\Entities\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Journal
 * @package App\Domain\Journals\Entities
 */
class Journal extends BaseModel
{
    use HasFactory;
    /**
     * @var array
     */
    protected $fillable = ['title', 'date', 'body'];

}
