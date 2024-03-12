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
}