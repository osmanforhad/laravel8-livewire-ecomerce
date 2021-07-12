<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        //fetch order by newest
        $orders = Order::orderBy('created_at', 'DESC')->get()->take(10);

        //define total sales by deliver status
        $totalSales = Order::where('status', 'delivered')->count();

        //count total reveneue by deliver status count
        $totalRevneue = Order::where('status', 'delivered')->sum('total');

        //define daily sales by deliver status and date function
        $todaySales = Order::where('status', 'delivered')->whereDate('created_at', Carbon::today())->count();

        //count dailyreveneue by deliver status count and with date function
        $todayRevneue = Order::where('status', 'delivered')->whereDate('created_at', Carbon::today())->sum('total');

        return view('livewire.admin.admin-dashboard', [
            'orders' => $orders,
            'totalSales' => $totalSales,
            'totalRevneue' => $totalRevneue,
            'todaySales' => $todaySales,
            'todayRevneue' => $todayRevneue,
        ])
            ->layout('layouts.base');
    }
}
