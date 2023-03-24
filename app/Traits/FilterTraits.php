<?php

namespace App\Traits;

use App\Constants\Variables;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Trait FilterTraits
 * @package App\Traits
 */
trait FilterTraits
{
    /**
     * @param $model
     * @param $params array
     * @param $searchFields array
     * @param $queryName string
     * @return mixed
     */
    public function applySearch($model, array $params, array $searchFields, $queryName = 'search')
    {
        if (isset($params[$queryName])) {
            $searchQuery = $params[$queryName];
            $model = $model->where(function ($query) use ($searchFields, $searchQuery) {
                foreach ($searchFields as $field) {
                    $query->orWhere($field, 'like', "%{$searchQuery}%");
                }
            });
        }
        return $model;
    }

    /**
     * @param $model
     * @param $params array
     * @param $sortableFields array
     * @param $queryName string
     * @return mixed
     */
    public function applySort($model, array $params, array $sortableFields, $queryName = 'sort')
    {
        if (isset($params[$queryName])) {
            $sortFields = $params[$queryName];
            $sortFields = explode(',', $sortFields);
            $sortRules = array_reduce($sortFields, function ($acc, $field) {
                $type = 'asc';
                if (strpos($field, '-') === 0) {
                    $type = 'desc';
                    $field = substr($field, 1);
                }
                return $acc + [
                        $field => $type,
                    ];
            }, []);

            if ($invalidSortFields = array_diff(array_keys($sortRules), $sortableFields)) {
                throw new BadRequestHttpException('Invalid sort fields: ' . implode(', ', $invalidSortFields));
            }

            foreach ($sortRules as $field => $type) {
                $model = $model->orderBy($field, $type);
            }
        }
        return $model;
    }

    /**
     * @param $model
     * @param $params array
     * @param $queryName string
     * @return mixed
     */
    public function applyStatusFilter($model, array $params, $queryName = 'status')
    {
        if (isset($params[$queryName])) {
            switch ($params[$queryName]) {
                case -1:
                    $model = $model;
                    break;
                case 0:
                    $model = $model->where($queryName, Variables::STATUS_UNPUBLISHED);
                    break;
                default:
                    $model = $model->where($queryName, Variables::STATUS_PUBLISHED);
                    break;
            }
        } else {
            $model = $model->where($queryName, Variables::STATUS_PUBLISHED);
        }
        return $model;
    }

    /**
     * @param $model
     * @param $params array
     * @param $startDateQuery string
     * @param $endDateQuery string
     * @param string $column
     * @return mixed
     */
    public function applyDateTimeRange($model, array $params, $startDateQuery = 'start_date', $endDateQuery = 'end_date', $column = 'created_at')
    {
        if (isset($params[$startDateQuery]) && isset($params[$endDateQuery])) {
            $startDate = $params[$startDateQuery];
            $endDate = $params[$endDateQuery];

            $splitStartDate = explode(' ', $startDate);
            $startTime = $splitStartDate[1] ?? null;

            if (is_null($startTime)) {
                $startDate = trim($startDate) . " " . trim(AppConstants::START_TIME);
            }
            $splitEndDate = explode(' ', $endDate);
            $endTime = $splitEndDate[1] ?? null;

            if (is_null($endTime)) {
                $endDate = trim($endDate . " " . trim(AppConstants::END_TIME));
            }

            $model = $model->where($column, '>=', $startDate);
            $model = $model->where($column, '<=', $endDate);
        }
        return $model;
    }

    /**
     * @param $model
     * @param $params array
     * @param $startDateQuery string
     * @param $endDateQuery string
     * @param string $column
     * @return mixed
     */
    public function applyDateRange($model, array $params, $startDateQuery = 'start_date', $endDateQuery = 'end_date', $column = 'created_at')
    {
        if (isset($params[$startDateQuery]) && isset($params[$endDateQuery])) {
            $startDate = $params[$startDateQuery];
            $endDate = $params[$endDateQuery];
            $model = $model->where($column, '>=', $startDate);
            $model = $model->where($column, '<=', $endDate);
        }
        return $model;
    }

    public function filterByCategory($model, $params, $fieldName = 'category_id')
    {
        if (isset($params[$fieldName])) {
            $model = $model->whereHas('categories', function ($q) use ($params, $fieldName) {
                $q->where('id', $params[$fieldName]);
            });
        }
        return $model;
    }

}
