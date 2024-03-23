<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $auth = auth()->user();
        $config = 'dashboard.home.index';
        $statistics_users = $this->statistics();
        return view('dashboard.layout', compact('auth','config','statistics_users'));
    }

    private function statistics() {
        // Lấy dữ liệu số lượng người dùng của các tháng trong năm hiện tại
        $users = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                        ->whereYear('created_at', date('Y'))
                        ->groupBy('month')
                        ->orderBy('month')
                        ->get();

        // Tính toán số lượng người dùng tăng hoặc giảm so với tháng trước
        $lastMonthCount = null;
        $statistics = [];
        foreach ($users as $user) {
            $month = $user->month;
            $count = $user->count;
            $increase = ($lastMonthCount === null) ? null : $count - $lastMonthCount;
            $status = ($increase === null) ? null : ($increase > 0 ? 'tăng' : 'giảm');
            $statistics[] = [
                'month' => $month,
                'count' => $count,
                'increase' => $increase,
                'status' => $status,
            ];
            $lastMonthCount = $count;
        }

        return $statistics;
    }
}
