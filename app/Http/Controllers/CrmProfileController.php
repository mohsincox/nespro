<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Division;
use App\Models\District;
use App\Models\PoliceStation;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Option;
use App\Models\Profile;

class CrmProfileController extends Controller
{
    public function create(Request $request)
    {
        $phoneNumber=preg_replace('/\D/', '',  $request->phone_number);          //  Deleting Non Numeric Characters
        if(substr($phoneNumber, 0, 1) == "+" ) $phoneNumber=substr($phoneNumber, 1);       //  Deleting + if in First Position
        if(substr($phoneNumber, 0, 2) == "88") $phoneNumber=substr($phoneNumber, 2);       //  Deleting 8 if in First Two Position
        //if(substr($phoneNumber, 0, 2) == "00") $phoneNumber=substr($phoneNumber, 2);       //  Deleting 0 if in First Two Position
        //if(substr($phoneNumber, 0, 1) == "0" ) $phoneNumber=substr($phoneNumber, 1);       //  Deleting 0 if in First Position
        //echo $phoneNumber;
        //die();
        //$profile = Profile::find(1);
        $profile = Profile::where('phone_number', $phoneNumber)->first();
        $agent = $request->agent;
    	$divisionList = Division::pluck('name', 'id');
    	$districtList = District::pluck('name', 'id');
    	$policeStationList = PoliceStation::pluck('name', 'id');
        $brandList = Brand::pluck('name', 'id');
        $brandNameList = Brand::pluck('name', 'name');
        $productList = Product::pluck('name', 'id');
        $consumerAgeList  = Option::where('select_id', 1)->where('status', 'Active')->pluck('name', 'name');
        $genderList  = Option::where('select_id', 2)->where('status', 'Active')->pluck('name', 'name');
        $professionList  = Option::where('select_id', 3)->where('status', 'Active')->pluck('name', 'name');
        $secList  = Option::where('select_id', 4)->where('status', 'Active')->pluck('name', 'name');
        $numberList  = Option::where('select_id', 5)->where('status', 'Active')->pluck('name', 'name');
        //$sourceOfKnowingList  = Option::where('select_id', 6)->where('status', 'Active')->pluck('name', 'name');
        $sourceOfKnowingList  = Option::where('select_id', 6)->where('status', 'Active')->get();
        $salesForceList  = Option::where('select_id', 7)->where('status', 'Active')->pluck('name', 'name');
        $CSIList  = Option::where('select_id', 8)->where('status', 'Active')->pluck('name', 'name');
        $interestedInCrmList  = Option::where('select_id', 9)->where('status', 'Active')->pluck('name', 'name');
        $reasonsOfCallList  = Option::where('select_id', 10)->where('status', 'Active')->pluck('name', 'name');
        $callCategoryList  = Option::where('select_id', 11)->where('status', 'Active')->pluck('name', 'name');
        
    	return view('crm_profile.create', compact('phoneNumber', 'agent', 'divisionList', 'districtList', 'policeStationList', 'brandList', 'brandNameList', 'productList','consumerAgeList', 'genderList', 'professionList', 'secList', 'numberList', 'sourceOfKnowingList', 'salesForceList', 'CSIList', 'interestedInCrmList', 'reasonsOfCallList', 'callCategoryList', 'profile'));
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

    public function brandProductShow(Request $request)
    {   
        $products = Product::where('brand_id', $request->brand_id)->get();
        foreach ($products as $product) {
            $brandWiseProductList['Product: '.$product->name.', SKU:'.$product->sku] = $product->name.', '.$product->sku;
        }
        return view('crm_profile.brand_product', compact('brandWiseProductList'));
    }

    public function store(Request $request)
    {
        //return $request->all();
       

        $profile = Profile::firstOrNew(array('phone_number' => $request->phone_number));
        $profile->phone_number = $request->phone_number;
        $profile->agent = $request->agent;
        $profile->consumer_name = $request->consumer_name;
        $profile->consumer_age = $request->consumer_age;
        $profile->consumer_gender = $request->consumer_gender;
        $profile->division_id = $request->division_id;
        $profile->district_id = $request->district_id;
        $profile->police_station_id = $request->police_station_id;
        $profile->address = $request->address;
        $profile->alternative_phone_number = $request->alternative_phone_number;
        $profile->profession = $request->profession;
        $profile->sec = $request->sec;
        $profile->number_of_child = $request->number_of_child;
        $profile->total_family_member = $request->total_family_member;
        if ($request->child1_DOB == null) {
            $profile->child1_DOB = null;
        } else {
            $profile->child1_DOB = $request->child1_DOB;
        }

        if ($request->child2_DOB == null) {
            $profile->child2_DOB = null;
        } else {
            $profile->child2_DOB = $request->child2_DOB;
        }

         if ($request->child3_DOB == null) {
            $profile->child3_DOB = null;
        } else {
            $profile->child3_DOB = $request->child3_DOB;
        }
        if ($request->prefered_brand == null) {
            $profile->prefered_brand = $request->prefered_brand;
        } else {
            $strPreferedBrand = implode(", ",$request->prefered_brand);
            //print_r (explode(", ",$strPreferedBrand));
            $profile->prefered_brand = $strPreferedBrand;
        }
        $profile->save();
        flash()->success($profile->phone_number.' Profile & CRM created successfully');
        return redirect()->back();
    }
}
