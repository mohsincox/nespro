<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Profile;
use Excel;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
    	return view('upload.create');
    }

    public function store(Request $request)
	{
		$input = Input::all();
	    $rules = [
	    	'file' => 'required|mimes:xlsx,xls'
	    	//'file' => 'required|mimes:xlsx,xls,csv,txt'
	    ];
	    $messages = [];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

		if(Input::hasFile('file')){
			$path = Input::file('file')->getRealPath();
			$results=Excel::load($path)->get();
			//print_r($results);
			foreach ($results as $row) {

				if(strlen($row['phone_number']) == 10) {
					$phoneNumber = '0'.$row['phone_number'];

				  	Profile::create([
				        'phone_number' => $phoneNumber,
				        'consumer_name' => $row->consumer_name,
				        'address' => $row->address,
				        'activity_campaign_name' => $row->activity_campaign_name,
				        'activity_date' => $row->activity_date,
				        'agent' => $row->agent
				    ]);


			    }

			}
  			flash()->success('Excel file imported successfully');
   			return redirect()->back();
		}
		flash()->error('Something Wrong.');
        return redirect()->back();
	}
}
