<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

class BaseRepository
{
    /**
     * Find By Column and Value
     *
     * @param mixed $value
     * @param string $column
     * @return Illuminate\Database\Eloquent\Model
     */
    public function findBy($value, $column = 'id')
    {
        return $this->model->where($column, $value)->first();
    }
    /**
     * Search the name attribute of a model with like operator
     * @param string $query
     * @return Illuminate/Support/Collection
     */
    public function searchNameLike($query = "")
    {
        return $this->model->where('name', 'like', "%" . $query . "%")->get();
    }

    public function search($value, $column): Collection
    {
        return $this->model->where($column, $value)->get();
    }
}
