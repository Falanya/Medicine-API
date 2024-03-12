<?php

namespace App\Services;

use App\Models\Province;
use App\Services\Interfaces\ProvinceServiceInterface;

/**
 * Class ProvinceService
 * @package App\Services
 */
class ProvinceService implements ProvinceServiceInterface
{
    public function all() {
        return Province::all();
    }
}