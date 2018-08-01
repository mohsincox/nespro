<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Profile;

class ProfileReportController extends Controller
{
    public function childAgeForm()
    {
    	return view('profile_report.child_age_form');
    }

    public function childAgeShow(Request $request)
    {
    	$startDate = $request->start_date.' 00:00:00';
        $endDate = $request->end_date.' 23:59:59';
        $startDateShow = $request->start_date;
        $endDateShow = $request->end_date;
    	return $profiles = Profile::whereBetween('child1_DOB', [$startDate, $endDate])
    									->orWhereBetween('child2_DOB', [$startDate, $endDate])
    									->orWhereBetween('child3_DOB', [$startDate, $endDate])
    									->get();
    }
}
