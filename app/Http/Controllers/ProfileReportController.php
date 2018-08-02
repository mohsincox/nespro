<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Profile;
use Validator;
use Illuminate\Support\Facades\Input;

class ProfileReportController extends Controller
{
    public function childAgeForm()
    {
    	return view('profile_report.child_age_form');
    }

    public function childAgeShow(Request $request)
    {
    	//return $request->all();
    	$input = Input::all();
	    $rules = [
	    	'start_date' => 'required',
	    	'end_date' => 'required',
	    	'child_start_date' => 'required',
	    	'child_end_date' => 'required'
	    ];
	    $messages = [
            
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

    	$startDate = $request->start_date.' 00:00:00';
        $endDate = $request->end_date.' 23:59:59';
        $startDateShow = $request->start_date;
        $endDateShow = $request->end_date;
        $childStartDate = $request->child_start_date;
        $childEndDate = $request->child_end_date;
        $intervalAge1 = date_diff(date_create(), date_create($childStartDate));
		$childStartAge = $intervalAge1->format("Year: %Y, Month: %M, Day: %D");
		$intervalAge2 = date_diff(date_create(), date_create($childEndDate));
		$childEndAge = $intervalAge2->format("Year: %Y, Month: %M, Day: %D");
    	$profiles = Profile::with(['division', 'district', 'policeStation'])
    							->whereBetween('updated_at', [$startDate, $endDate])
								->where(function ($query) use ($childStartDate, $childEndDate) {
        							$query->whereBetween('child1_DOB', [$childStartDate, $childEndDate])
        							->orWhereBetween('child2_DOB', [$childStartDate, $childEndDate])
        							->orWhereBetween('child3_DOB', [$childStartDate, $childEndDate]);	
    							})
								->get();
		
        return view('profile_report.child_age_show', compact('profiles', 'startDateShow', 'endDateShow', 'childStartAge', 'childEndAge'));
    }

    public function getYMD(Request $request)
    {
        $dateOfBirth = $request->dateOfBirth;
        $interval = date_diff(date_create(), date_create($dateOfBirth));
        return $interval->format("Year: %Y, Month: %M, Day: %D");
    }

    public function childAgeFormNew()
    {
    	return view('profile_report.child_age_form_new');
    }

    public function childAgeShowNew(Request $request)
    {
    	//return $request->all();
    	$startDate = '2018-01-01 00:00:00';
        $endDate = '2018-08-02 23:59:59';

    	$fromYearToDay = 365 * $request->from_year;
    	$fromMonthToDay = 30 * $request->from_month;
    	$fromTotalDay = $fromYearToDay + $fromMonthToDay;
    	$fromDate = date('Y-m-d',strtotime(date("Y-m-d", time()) . " - ".$fromTotalDay." day"));

    	$toYearToDay = 365 * $request->to_year;
    	$toMonthToDay = 30 * $request->to_month;
    	$toTotalDay = $toYearToDay + $toMonthToDay;
    	$toDate = date('Y-m-d',strtotime(date("Y-m-d", time()) . " - ".$toTotalDay." day"));

    	$intervalAge1 = date_diff(date_create(), date_create($fromDate));
		$childStartAge = $intervalAge1->format("Year: %Y, Month: %M, Day: %D");
		$intervalAge2 = date_diff(date_create(), date_create($toDate));
		$childEndAge = $intervalAge2->format("Year: %Y, Month: %M, Day: %D");
    	$profiles = Profile::with(['division', 'district', 'policeStation'])
    							->whereBetween('updated_at', [$startDate, $endDate])
								->where(function ($query) use ($fromDate, $toDate) {
        							$query->whereBetween('child1_DOB', [$toDate, $fromDate])
        							->orWhereBetween('child2_DOB', [$toDate, $fromDate])
        							->orWhereBetween('child3_DOB', [$toDate, $fromDate]);	
    							})
								->get();
		
        return view('profile_report.child_age_show_new', compact('profiles', 'startDateShow', 'endDateShow', 'childStartAge', 'childEndAge'));
    }
}
