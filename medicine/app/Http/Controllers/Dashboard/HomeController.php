<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductOrder;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $auth = auth()->user();
        $config = 'dashboard.home.index';
        $statistics_users = $this->statistics_users();
        $statistics_orders = $this->statistics_orders();
        $statistics_income = $this->statistics_income();

        $users_chart = $this->users_chart();
        $orders_chart = $this->orders_chart();
        $income_chart = $this->income_chart();

        return view('dashboard.layout', compact('auth','config','statistics_users',
        'statistics_orders','statistics_income','users_chart','orders_chart','income_chart'));
    }

    private function statistics_users() {
        $users = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                        ->whereYear('created_at', date('Y'))
                        ->groupBy('month')
                        ->orderBy('month')
                        ->where('role_id', 1)
                        ->whereNotNull('email_verified_at')
                        ->get();

        $lastMonthCount = null;
        $statistics = [];
        $total = 0;
        foreach ($users as $user) {
            $month = $user->month;
            $count = $user->count;
            $total += $count;
            $increase = ($lastMonthCount === null) ? null : ($count > $lastMonthCount ? $count - $lastMonthCount : $lastMonthCount - $count);
            $status = ($increase === null) ? null : ($count < $lastMonthCount ? 'decrease' : 'increase');
            $percent = ($increase === null) ? null : ($increase / $lastMonthCount * 100);
            $statistics[] = [
                'month' => $month,
                'count' => $count,
                'lastMonthCount' => $lastMonthCount,
                'result' => $increase,
                'status' => $status,
                'total' => $total,
                'percent' => $percent === null ? null : floor($percent).'%',
            ];
            $lastMonthCount = $count;

        }
        // dd($statistics);

        return $statistics;
    }

    private function statistics_orders(){
        $orders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                        ->whereYear('created_at', date('Y'))
                        ->groupBy('month')
                        ->orderBy('month')
                        ->where('status', 3)
                        ->get();
        $lastMonthCount = null;
        $statistics = [];
        $total_orders = 0;
        foreach ($orders as $order){
            $count = $order->count;
            $month = $order->month;
            $total_orders += $count;
            $increase = ($lastMonthCount === null) ? null : ($count < $lastMonthCount ? $lastMonthCount - $count : $count - $lastMonthCount);
            $status = ($increase === null) ? null : ($count < $lastMonthCount ? 'decrease' : 'increase');
            $percent = ($increase === null) ? null : ($increase / $lastMonthCount * 100);

            $statistics[] = [
                'month' => $month,
                'count' => $count,
                'lastMonthCount' => $lastMonthCount,
                'result' => $increase,
                'status' => $status,
                'total_orders' => $total_orders,
                'percent' => $percent === null ? null : floor($percent).'%',
            ];
            $lastMonthCount = $count;
        }
        // dd($statistics);
        return $statistics;
    }

    private function statistics_income() {
        $income = ProductOrder::selectRaw('MONTH(created_at) as month, COUNT(*) as count, SUM(price * quantity) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->where('status', 1)
            ->get();

        $lastMonthCount = null;
        $statistics = [];
        $total = 0;
        foreach($income as $item){
            $month = $item->month;
            $count = $item->count;
            $total += $item->total;
            $total_current = $item->total;
            $increase = ($lastMonthCount === null) ? null : ($lastMonthCount < $total_current ? $total_current - $lastMonthCount : $lastMonthCount - $total_current);
            $status = ($increase === null) ? null : ($lastMonthCount < $total_current ? 'increase' : 'decrease');
            $percent = ($increase === null) ? null : ($increase / $lastMonthCount * 100);
            $statistics[] = [
                'month' => $month,
                'count' => $count,
                'lastMonthCount' => $lastMonthCount,
                'total_current' => $total_current,
                'total' => $total,
                'status' => $status,
                'percent' => floor($percent).'%',
            ];
            $lastMonthCount = $total_current;
        }
        // dd($statistics);
        return $statistics;
    }

    private function users_chart() {
        $users = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->where('role_id', 1)
            ->whereNotNull('email_verified_at')
            ->get();

        $labels = [];
        $data = [];
        $colors = ['#FF6384','#36A2EB','#FFCE56','#8BC34A','#FF5722','#009688','#795548','#9C27B0','#2196F3','#FF9800','CDDC39','#607D8B'];

        for($i = 1; $i < 12; $i++) {
            $month = date('F', mktime(0,0,0,$i,1));
            $count = 0;

            foreach($users as $user) {
                if($user->month == $i) {
                    $count = $user->count;
                    break;
                }
            }

            array_push($labels,$month);
            array_push($data,$count);
        }

        $datasets = [
            [
                'label' => 'Users',
                'data' => $data,
                'backgroundColor' => $colors,
            ]
        ];

        return compact('datasets','labels');
    }

    private function orders_chart() {
        $orders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->where('status', 3)
            ->get();
        $labels = [];
        $data = [];
        $colors = ['#FF6384','#36A2EB','#FFCE56','#8BC34A','#FF5722','#009688','#795548','#9C27B0','#2196F3','#FF9800','CDDC39','#607D8B'];

        for($i=1;$i<12;$i++) {
            $month = date('F', mktime(0,0,0,$i,1));
            $count = 0;

            foreach($orders as $order) {
                if($order->month == $i) {
                    $count = $order->count;
                    break;
                }
            }

            array_push($labels,$month);
            array_push($data,$count);
        }

        $datasets = [
            [
                'label' => 'Orders',
                'data' => $data,
                'backgroundColor' => $colors,
            ]
        ];

        return compact('datasets','labels');
    }

    private function income_chart() {
        $income = ProductOrder::selectRaw('MONTH(created_at) as month, COUNT(*) as count, SUM(price*quantity) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->where('status', 1)
            ->get();
        $labels = [];
        $data = [];
        $colors = ['#FF6384','#36A2EB','#FFCE56','#8BC34A','#FF5722','#009688','#795548','#9C27B0','#2196F3','#FF9800','CDDC39','#607D8B'];
        $datasets = [];
        for($i = 1; $i < 12; $i++) {
            $month = date('F', mktime(0,0,0,$i,1));
            $total = 0;

            foreach($income as $item) {
                if($item->month == $i) {
                    $total = $item->total;
                    break;
                }
            }
            array_push($labels,$month);
            array_push($data,$total);
        }
        $datasets[] = [
            'label' => 'Income',
            'data'=> $data,
            'backgroundColor'=> $colors,
        ];
        return compact('datasets','labels');
    }
}
