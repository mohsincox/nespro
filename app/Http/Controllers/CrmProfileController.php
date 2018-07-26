<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Division;
use App\Models\District;
use App\Models\PoliceStation;

class CrmProfileController extends Controller
{
    public function create()
    {
    	$divisionList = Division::pluck('name', 'id');
    	$districtList = District::pluck('name', 'id');
    	$policeStationList = PoliceStation::pluck('name', 'id');
    	return view('crm_profile.create', compact('divisionList', 'districtList', 'policeStationList'));
    }

    public function getYMD(Request $request)
    {
        $dateOfBirth = $request->dateOfBirth;
        return view('crm_profile.get_ymd', compact('dateOfBirth'));
    }

    public function divisionDistrictShow(Request $request)
    {   
        $districts = District::where('division_id', $request->division_id)->get();
        foreach ($districts as $district) {
            $divWiseDistrictList[$district->id] = $district->name;
        }
        return view('crm_profile.division_district', compact('divWiseDistrictList'));
    }

    public function districtPsShow(Request $request)
    {   
        $policeStations = PoliceStation::where('district_id', $request->district_id)->get();
        foreach ($policeStations as $policeStation) {
            $disWisePsList[$policeStation->id] = $policeStation->name;
        }
        return view('crm_profile.district_ps', compact('disWisePsList'));
    }
}
