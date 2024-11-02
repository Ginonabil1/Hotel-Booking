<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Bookings;



class ReportController extends Controller
{
    public function BookingReport(){
        return view('backend.report.booking_report');
    }


    public function BookingSearch(Request $request){
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if (($request->start_date and $request->end_date) and ($start_date <= $end_date) ){
            $bookings = Bookings::where('check_in' ,'>=' , $start_date)->where('check_out' ,'<=' , $end_date)->get();
        }else{
            $notification = array(
                'message' => 'Something wrong!!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification); 
        }
        return view('backend.report.booking_search_date',compact('start_date','end_date','bookings'));
    }
}
