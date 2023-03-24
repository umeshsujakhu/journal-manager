<?php

namespace App\Domain\Journals\Repositories;

use App\Constants\Variables;
use App\Core\Repositories\BaseRepository;
use App\Domain\Journals\Interfaces\JournalInterface;
use App\Domain\Journals\Entities\Journal;

/**
 * Class JournalRepository
 * @package App\Domain\Journals\Repositories
 */
class JournalRepository extends BaseRepository implements JournalInterface
{
    /**
     * @var Journal
     */
    protected $model;

    /**
     * JournalRepository constructor.
     *
     * @param Journal $model
     */
    public function __construct(Journal $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function getPaginatedList($request)
    {
        if ($request->input('date')) {
            $this->model = $this->model->where('date', $request->input('date'));
        }
        return $this->model->paginate($request->input('page_size', Variables::DEFAULT_PAGINATE_PER_PAGE));
    }

}
