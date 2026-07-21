<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Client;
use App\Models\Order;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $productCount = Product::where('status', '=', '1')->count();
        $clientCount = Client::where('status', '=', '1')->count();
        $date_order = Carbon::now();
        $date_order = $date_order->format('Y-m-d');
        $saleCountDay = Order::whereDate('date_order', '=', Carbon::now()->format('Y-m-d'))->get()->count("id");
        $saleTotalDay = Order::whereDate('date_order', '=', Carbon::now()->format('Y-m-d'))->sum("total");
        $saleCountMonth = Order::whereMonth('date_order', date('m'))->get()->count("id");
        $saleTotalMonth = Order::whereMonth('date_order', date('m'))->sum("total");
        return view('home', compact('productCount', 'clientCount', 'saleCountDay', 'saleTotalDay', 'saleCountMonth', 'saleTotalMonth'));
    }
}