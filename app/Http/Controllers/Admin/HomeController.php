<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

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
        $getTopSellingPrd = DB::select("SELECT od.product_id, SUM(od.quantity) AS TotalQuantity , p.name  FROM order_details od  LEFT JOIN products p ON od.product_id = p.id  GROUP BY od.product_id ORDER BY SUM(od.quantity) DESC LIMIT 0,10 ");
        $no = 1;
        return view('home',['getTopSellingPrd' => $getTopSellingPrd,'no' => $no]);
    }
}
