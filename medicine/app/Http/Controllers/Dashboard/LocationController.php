<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\DistrictServiceInterface as DistrictService;

class LocationController extends Controller
{
    protected $districtService;

    public function __construct(DistrictService $districtServiceInterface) {
        $this->districtService = $districtServiceInterface;
    }

    public function getLocation(Request $request) {
        $province_id = $request->input('province_id');
        $districts = $this->districtService->findDistrictByProvinceId($province_id);
        $response = [
            'html' => $this->renderHtml($districts)
        ];
        return response()->json($response);
    }

    public function renderHtml($districts) {
        $html = '<option value="0">[Chọn Quận/Huyện]</option>';
        foreach($districts as $district) {
            $html .= '<option value="'.$district->code.'">'.$district->name.'</option>';
        }
        return $html;
    }
}