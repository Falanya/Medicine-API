<?php

namespace App\Services;

use App\Models\Province;
use App\Models\User;
use App\Services\Interfaces\ProvinceServiceInterface;

/**
 * Class ProvinceService
 * @package App\Services
 */
class ProvinceService extends BaseService implements ProvinceServiceInterface
{
    protected $model;
    
    public function __construct(Province $model){
        $this->model = $model;
    }
}