<?php

namespace App\Services;

use App\Models\District;
use App\Services\Interfaces\DistrictServiceInterface;
use App\Services\BaseService;

/**
 * Class DistrictService
 * @package App\Services
 */
class DistrictService extends BaseService implements DistrictServiceInterface
{
    protected $model;

    public function __construct(District $model) {
        $this->model = $model;
    }

    public function findDistrictByProvinceId(int $province_id) {
        return $this->model->where('province_code', $province_id)->get();
    }
}