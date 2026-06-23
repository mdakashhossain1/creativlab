<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Models\User;
use Modules\Ecommerce\Entities\Order;
use Modules\Ecommerce\Entities\Product;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function dashboard(){

        $active_orders = Order::where('order_status', Status::APPROVED)->latest()->count();

        $complete_orders = Order::where(function ($query) {
            $query->where('order_status', Status::COMPLETED);
        })->latest()->count();

        $cancel_orders = Order::where(function ($query) {
            $query->where('order_status', Status::REJECTED);
        })->latest()->count();

        $total_orders = Order::count();
        $total_users = User::count();
        $total_products = Product::count();
        $total_revenue = Order::where('payment_status', Status::ENABLE)->sum('total');
        $today_revenue = Order::where('payment_status', Status::ENABLE)->whereDate('created_at', today())->sum('total');
        $today_orders = Order::whereDate('created_at', today())->count();
        $new_users_this_month = User::whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->count();

        $lable = array();
        $data = array();
        $start = new Carbon('first day of this month');
        $last = new Carbon('last day of this month');
        $first_date = $start->format('Y-m-d');
        $last_date = $last->format('Y-m-d');
        $today = date('Y-m-d');
        $length = date('d')-$start->format('d');

        for($i=1; $i <= $length+1; $i++){

            $date = '';
            if($i == 1){
                $date = $first_date;
            }else{
                $date = $start->addDays(1)->format('Y-m-d');
            };

            $sum = Order::whereDate('created_at', $date)->sum('total');
            $data[] = $sum;
            $lable[] = $i;

        }

        $data = json_encode($data);
        $lable = json_encode($lable);

        // User registration chart — last 12 months
        $reg_labels = [];
        $reg_data = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $reg_labels[] = $month->format('M Y');
            $reg_data[] = User::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }
        $reg_labels = json_encode($reg_labels);
        $reg_data = json_encode($reg_data);

        // Order status breakdown for doughnut chart
        $pending_orders = Order::where('order_status', Status::PENDING)->count();
        $processing_orders = Order::where('order_status', Status::PROCESSING)->count();
        $shipped_orders = Order::where('order_status', Status::SHIPPED)->count();

        // Monthly revenue vs orders — last 6 months
        $monthly_labels = [];
        $monthly_revenue = [];
        $monthly_order_counts = [];
        for ($i = 5; $i >= 0; $i--) {
            $m = Carbon::now()->subMonths($i);
            $monthly_labels[] = $m->format('M Y');
            $monthly_revenue[] = (float) Order::where('payment_status', Status::ENABLE)
                ->whereYear('created_at', $m->year)
                ->whereMonth('created_at', $m->month)
                ->sum('total');
            $monthly_order_counts[] = Order::whereYear('created_at', $m->year)
                ->whereMonth('created_at', $m->month)
                ->count();
        }
        $monthly_labels = json_encode($monthly_labels);
        $monthly_revenue = json_encode($monthly_revenue);
        $monthly_order_counts = json_encode($monthly_order_counts);

        $orders = Order::with('order_detail.singleProduct.translate')->latest()->take(10)->get();

        $cron_last_run = Cache::get('cron_last_heartbeat');
        $cron_is_running = $cron_last_run && Carbon::parse($cron_last_run)->diffInMinutes(now()) < 2;
        $cron_token = substr(hash('sha256', config('app.key')), 0, 32);
        $cron_url = url('/cron/run?token=' . $cron_token);

        return view('admin.dashboard', [
            'lable' => $lable,
            'data' => $data,
            'active_orders' => $active_orders,
            'complete_orders' => $complete_orders,
            'cancel_orders' => $cancel_orders,
            'total_orders' => $total_orders,
            'orders' => $orders,
            'total_users' => $total_users,
            'reg_labels' => $reg_labels,
            'reg_data' => $reg_data,
            'pending_orders' => $pending_orders,
            'processing_orders' => $processing_orders,
            'shipped_orders' => $shipped_orders,
            'total_products' => $total_products,
            'total_revenue' => $total_revenue,
            'today_revenue' => $today_revenue,
            'today_orders' => $today_orders,
            'new_users_this_month' => $new_users_this_month,
            'monthly_labels' => $monthly_labels,
            'monthly_revenue' => $monthly_revenue,
            'monthly_order_counts' => $monthly_order_counts,
            'cron_is_running' => $cron_is_running,
            'cron_last_run' => $cron_last_run,
            'cron_url' => $cron_url,
        ]);
    }
}
