<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DateTime;

class ReportController extends Controller{
    public function report(){
      return view('admin.report.index');
    }

    // ============== Selling Report ===================
    public function sellingReportProcess(Request $request){
        $fromdate = new DateTime($request->formDate);
        $start = $fromdate->format('d F Y');

        $toDate = new DateTime($request->toDate);
        $end = $toDate->format('d F Y');

        $orders = Order::whereBetween('order_date',[$start,$end])->latest()->get();

        return view('admin.report.reports',compact('orders','start','end'));
    }

    // ============== Return Report ===================
    public function returnReportProcess(Request $request){

    }

}
