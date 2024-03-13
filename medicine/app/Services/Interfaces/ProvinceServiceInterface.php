<?php

namespace App\Services\Interfaces;

/**
 * Interface ProvinceServiceInterface
 * @package App\Services\Interfaces
 */
interface ProvinceServiceInterface
{
    public function getAll();

    public function findById($id);
}