<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\DistrictServiceInterface as DistrictService;
use App\Services\Interfaces\ProvinceServiceInterface as ProvinceService;

class LocationController extends Controller
{
    protected $districtService;
    protected $provinceService;

    public function __construct(DistrictService $districtServiceInterface, ProvinceService $provinceServiceInterface) {
        $this->districtService = $districtServiceInterface;
        $this->provinceService = $provinceServiceInterface;
    }

    public function getLocation(Request $request) {
        $get = $request->input();
        $html = '';
        if($get['target'] == 'districts') {
            $provinces = $this->provinceService->findById($get['data']['location_id'], ['code','name'], ['districts']);
            $html = $this->renderHtml($provinces->districts);
        } else if($get['target'] == 'wards') {
            $district = $this->districtService->findById($get['data']['location_id'], ['code','name'], ['wards']);
            $html = $this->renderHtml($district->wards, '[Chọn Phường/Xã]');
        }
        $response = [
            'html' => $html
        ];
        return response()->json($response);
    }

    public function renderHtml($districts, $root = '[Chọn Quận/Huyện]') {
        $html = '<option value="0">'.$root.'</option>';
        foreach($districts as $district) {
            $html .= '<option value="'.$district['code'].'">'.$district['name'].'</option>';
        }
        return $html;
    }
}