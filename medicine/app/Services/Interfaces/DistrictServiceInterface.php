<?php

namespace App\Services\Interfaces;

/**
 * Interface DistrictServiceInterface
 * @package App\Services\Interfaces
 */
interface DistrictServiceInterface
{
    public function getAll();
    public function findDistrictByProvinceId(int $province_id);
    public function findById($id);
}