<?php

namespace App\Domain\Journals\Interfaces;

use App\Core\Interfaces\BasicCrudInterface;
use Illuminate\Http\Request;

/**
 * Interface JournalInterface
 * @package App\Domain\Journals\Interfaces
 */
interface JournalInterface extends BasicCrudInterface
{
    public function getPaginatedList(Request $request);
}
