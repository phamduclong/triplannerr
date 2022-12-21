<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\TourImages;

/**
 * Class HomeController.
 */
class TourReportController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tours = Tour::with('tour_images')->where(['status'=>'1'])->orderby('id', 'desc')->get();
        //dd($tours);
        return view('frontend.tour_report_list', compact('tours'));
    }

}
