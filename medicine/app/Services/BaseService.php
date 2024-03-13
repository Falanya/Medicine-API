<?php

namespace App\Services;

use App\Services\Interfaces\BaseServiceInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseService
 * @package App\Services
 */
class BaseService implements BaseServiceInterface
{
    protected $model;

    public function __construct(Model $model){
        $this->model = $model;
    }

    public function getAll() {
        return $this->model->all();
    }

    // public function findById($modeId, array $column = ['*'], array $relation = []) {
    //     return $this->model->select($column)->with($relation)->findOrFail($modeId);
    // }
}