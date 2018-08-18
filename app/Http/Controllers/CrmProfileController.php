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
use App\Models\Crm;
use Excel;

class CrmProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $phoneNumber=preg_replace('/\D/', '',  $request->phone_number);
        if(substr($phoneNumber, 0, 1) == "+" ) $phoneNumber=substr($phoneNumber, 1);
        if(substr($phoneNumber, 0, 2) == "88") $phoneNumber=substr($phoneNumber, 2);
        //if(substr($phoneNumber, 0, 2) == "00") $phoneNumber=substr($phoneNumber, 2);
        //if(substr($phoneNumber, 0, 1) == "0" ) $phoneNumber=substr($phoneNumber, 1);
        
        $profile = Profile::where('phone_number', $phoneNumber)->first();
        $crmLast = Crm::where('phone_number', $phoneNumber)->orderBy('id', 'desc')->first();
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
        
    	return view('crm_profile.create', compact('phoneNumber', 'agent', 'divisionList', 'districtList', 'policeStationList', 'brandList', 'brandNameList', 'productList','consumerAgeList', 'genderList', 'professionList', 'secList', 'numberList', 'sourceOfKnowingList', 'salesForceList', 'CSIList', 'interestedInCrmList', 'reasonsOfCallList', 'callCategoryList', 'profile', 'crmLast'));
    }

    public function getYMD(Request $request)
    {
        $dateOfBirth = $request->dateOfBirth;
        $interval = date_diff(date_create(), date_create($dateOfBirth));
        return $interval->format("%yy, %mm, %dd");
        //return view('crm_profile.get_ymd', compact('dateOfBirth'));
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
        $phoneNumber=preg_replace('/\D/', '',  $request->phone_number);          
        if(substr($phoneNumber, 0, 1) == "+" ) $phoneNumber=substr($phoneNumber, 1);       
        if(substr($phoneNumber, 0, 2) == "88") $phoneNumber=substr($phoneNumber, 2);
       
        $profile = Profile::firstOrNew(array('phone_number' => $phoneNumber));
        $profile->phone_number = $phoneNumber;
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

        $crm = new Crm;
        $crm->profile_id = $profile->id;
        $crm->phone_number = $profile->phone_number;
        $crm->brand_id = $request->brand_id;
        $crm->product = $request->product;
        $crm->competition_brand_usage = $request->competition_brand_usage;
        $crm->activity_campaign_name = $request->activity_campaign_name;
        $crm->source_of_knowing = $request->source_of_knowing;
        $crm->ccid = $request->ccid;
        $crm->sales_force = $request->sales_force;
        $crm->consumer_satisfaction_index = $request->consumer_satisfaction_index;
        $crm->interested_in_crm = $request->interested_in_crm;
        $crm->reasons_of_call = $request->reasons_of_call;
        $crm->call_category = $request->call_category;
        $crm->verbatim = $request->verbatim;
        $crm->save();

        flash()->success($profile->phone_number.' Profile & CRM created successfully');
        return redirect()->back();
    }

    public function crmReportForm()
    {

        return view('crm_profile.report.form');
    }

    public function crmReportShow(Request $request)
    {
        //return $request->all();
        $startDate = $request->start_date.' 00:00:00';
        $endDate = $request->end_date.' 23:59:59';
        $startDateShow = $request->start_date;
        $endDateShow = $request->end_date;
        $crms = Crm::with(['profile', 'profile.division', 'profile.district', 'profile.policeStation', 'brand'])->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'desc')->get();
        return view('crm_profile.report.index', compact('crms', 'startDateShow', 'endDateShow'));
    }

    public function crmReportFormExcel()
    {

        return view('crm_profile.report.form_excel');
    }

    public function crmReportShowExcel(Request $request)
    {
        //return $request->all();
        $startDate = $request->start_date.' 00:00:00';
        $endDate = $request->end_date.' 23:59:59';
        $type = $request->type;
        $startDateShow = $request->start_date;
        $endDateShow = $request->end_date;
       
        Excel::create('CrmProfile'.$startDateShow.$endDateShow, function($excel) use ($startDate,  $endDate, $type) {

            $excel->sheet('Sheet1', function($sheet) use ($startDate,  $endDate, $type) {

                $crms = Crm::with(['profile', 'profile.division', 'profile.district', 'profile.policeStation', 'brand'])->whereBetween('created_at', [$startDate, $endDate])->get();

                $arr =array();
                foreach($crms as $crm) {
                    if (isset($crm->profile->division->name)) {
                        $division = $crm->profile->division->name;
                    } else {
                        $division = null;
                    }
                    if (isset($crm->profile->district->name)) {
                        $district = $crm->profile->district->name;
                    } else {
                        $district = null;
                    }
                    if (isset($crm->profile->policeStation->name)) {
                        $policeStation = $crm->profile->policeStation->name;
                    } else {
                        $policeStation = null;
                    }
                    if ($crm->profile->child1_DOB == null) {
                        $child1Age = null;
                    } else {
                        $child1_DOB = $crm->profile->child1_DOB;
                        $interval1 = date_diff(date_create(), date_create($child1_DOB));
                        $child1Age = $interval1->format("%yy, %mm, %dd");
                    }
                    
                    if ($crm->profile->child2_DOB == null) {
                        $child2Age = null;
                    } else {
                        $child2_DOB = $crm->profile->child2_DOB;
                        $interval2 = date_diff(date_create(), date_create($child2_DOB));
                        $child2Age = $interval2->format("%yy, %mm, %dd");
                    }

                    if ($crm->profile->child3_DOB == null) {
                        $child3Age = null;
                    } else {
                        $child3_DOB = $crm->profile->child3_DOB;
                        $interval3 = date_diff(date_create(), date_create($child3_DOB));
                        $child3Age = $interval3->format("%yy, %mm, %dd");
                    }
                    if (isset($crm->brand->name)) {
                        $brandName = $crm->brand->name;
                    } else {
                        $brandName = null;
                    }

                    $data =  array($crm->id, $crm->phone_number,  $crm->profile->consumer_name, $crm->profile->consumer_age, $crm->profile->consumer_gender, $division, $district, $policeStation, $crm->profile->address, $crm->profile->alternative_phone_number, $crm->profile->profession, $crm->profile->sec, $crm->profile->number_of_child, $crm->profile->total_family_member, $child1Age, $child2Age, $child3Age, $crm->profile->prefered_brand, $brandName, $crm->product, $crm->competition_brand_usage, $crm->activity_campaign_name, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $crm->profile->agent, $crm->created_at);
                    array_push($arr, $data);
                }
                
                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Prefered Brand', 'Brand', 'Product', 'Com. Brand Usage', 'Act or Camp. Name', 'Source of Knowing', 'CCID', 'Sales Force', 'CSI', 'Interested CRM', 'Reasons', 'Category', 'Verbatim', 'Agent', 'Created At'
                    )

                );

            });

        })->export($type);
    }

    public function brandWiseForm()
    {
        $brandList = Brand::pluck('name', 'id');
        return view('crm_profile.report.brand_wise_form', compact('brandList'));
    }

    public function brandWiseShow(Request $request)
    {
        //return $request->all();
        $brand = Brand::find($request->brand_id);
        $crms = Crm::with(['profile', 'profile.division', 'profile.district', 'profile.policeStation', 'brand'])->where('brand_id', $request->brand_id)->orderBy('id', 'desc')->get();
        return view('crm_profile.report.brand_wise_show', compact('crms', 'startDateShow', 'endDateShow', 'brand'));
    }

    public function brandWiseFormExcel()
    {
        $brandList = Brand::pluck('name', 'id');
        return view('crm_profile.report.brand_wise_form_excel', compact('brandList'));
    }

    public function brandWiseShowExcel(Request $request)
    {
        //return $request->all();
        $brandId = $request->brand_id;
        $type = $request->type;
       
        Excel::create('BrandWise', function($excel) use ($brandId, $type) {

            $excel->sheet('Sheet1', function($sheet) use ($brandId, $type) {

                $crms = Crm::with(['profile', 'profile.division', 'profile.district', 'profile.policeStation', 'brand'])->where('brand_id', $brandId)->get();

                $arr =array();
                foreach($crms as $crm) {
                    if (isset($crm->profile->division->name)) {
                        $division = $crm->profile->division->name;
                    } else {
                        $division = null;
                    }
                    if (isset($crm->profile->district->name)) {
                        $district = $crm->profile->district->name;
                    } else {
                        $district = null;
                    }
                    if (isset($crm->profile->policeStation->name)) {
                        $policeStation = $crm->profile->policeStation->name;
                    } else {
                        $policeStation = null;
                    }
                    if ($crm->profile->child1_DOB == null) {
                        $child1Age = null;
                    } else {
                        $child1_DOB = $crm->profile->child1_DOB;
                        $interval1 = date_diff(date_create(), date_create($child1_DOB));
                        $child1Age = $interval1->format("%yy, %mm, %dd");
                    }
                    
                    if ($crm->profile->child2_DOB == null) {
                        $child2Age = null;
                    } else {
                        $child2_DOB = $crm->profile->child2_DOB;
                        $interval2 = date_diff(date_create(), date_create($child2_DOB));
                        $child2Age = $interval2->format("%yy, %mm, %dd");
                    }

                    if ($crm->profile->child3_DOB == null) {
                        $child3Age = null;
                    } else {
                        $child3_DOB = $crm->profile->child3_DOB;
                        $interval3 = date_diff(date_create(), date_create($child3_DOB));
                        $child3Age = $interval3->format("%yy, %mm, %dd");
                    }
                    if (isset($crm->brand->name)) {
                        $brandName = $crm->brand->name;
                    } else {
                        $brandName = null;
                    }

                    $data =  array($crm->id, $crm->phone_number,  $crm->profile->consumer_name, $crm->profile->consumer_age, $crm->profile->consumer_gender, $division, $district, $policeStation, $crm->profile->address, $crm->profile->alternative_phone_number, $crm->profile->profession, $crm->profile->sec, $crm->profile->number_of_child, $crm->profile->total_family_member, $child1Age, $child2Age, $child3Age, $crm->profile->prefered_brand, $brandName, $crm->product, $crm->competition_brand_usage, $crm->activity_campaign_name, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $crm->profile->agent, $crm->created_at);
                    array_push($arr, $data);
                }
                
                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Prefered Brand', 'Brand', 'Product', 'Com. Brand Usage', 'Act or Camp. Name', 'Source of Knowing', 'CCID', 'Sales Force', 'CSI', 'Interested CRM', 'Reasons', 'Category', 'Verbatim', 'Agent', 'Created At'
                    )
                );
            });
        })->export($type);
    }

    public function brandAndDivWiseForm()
    {
        $brandList = Brand::pluck('name', 'id');
        $divisionList = Division::pluck('name', 'id');
        return view('crm_profile.report.brand_and_div_wise_form', compact('brandList', 'divisionList'));
    }

    public function brandAndDivWiseShow(Request $request)
    {
        $divisionId = $request->division_id;
        $brandId = $request->brand_id;
        $brand = Brand::find($brandId);
        $division = Division::find($divisionId);
        $crms = Crm::with(['profile', 'profile.division', 'profile.district', 'profile.policeStation', 'brand'])->whereHas('profile', function ($query) use($divisionId) {
                $query->where('division_id', $divisionId);
            })->where('brand_id', $brandId)
            ->orderBy('id', 'desc')->get();

        return view('crm_profile.report.brand_and_div_wise_show', compact('crms', 'brand', 'division'));
    }

    public function brandAndDivWiseFormExcel()
    {
        $brandList = Brand::pluck('name', 'id');
        $divisionList = Division::pluck('name', 'id');
        return view('crm_profile.report.brand_and_div_wise_form_excel', compact('brandList', 'divisionList'));
    }

    public function brandAndDivWiseShowExcel(Request $request)
    {
        //return $request->all();
        $brandId = $request->brand_id;
        $divisionId = $request->division_id;
        $type = $request->type;
       
        Excel::create('BrandAndDivisionWise', function($excel) use ($brandId, $divisionId, $type) {

            $excel->sheet('Sheet1', function($sheet) use ($brandId, $divisionId, $type) {

                $crms = Crm::with(['profile', 'profile.division', 'profile.district', 'profile.policeStation', 'brand'])->whereHas('profile', function ($query) use($divisionId) {
                         $query->where('division_id', $divisionId);
                    })->where('brand_id', $brandId)
                      ->get();

                $arr =array();
                foreach($crms as $crm) {
                    if (isset($crm->profile->division->name)) {
                        $division = $crm->profile->division->name;
                    } else {
                        $division = null;
                    }
                    if (isset($crm->profile->district->name)) {
                        $district = $crm->profile->district->name;
                    } else {
                        $district = null;
                    }
                    if (isset($crm->profile->policeStation->name)) {
                        $policeStation = $crm->profile->policeStation->name;
                    } else {
                        $policeStation = null;
                    }
                    if ($crm->profile->child1_DOB == null) {
                        $child1Age = null;
                    } else {
                        $child1_DOB = $crm->profile->child1_DOB;
                        $interval1 = date_diff(date_create(), date_create($child1_DOB));
                        $child1Age = $interval1->format("%yy, %mm, %dd");
                    }
                    
                    if ($crm->profile->child2_DOB == null) {
                        $child2Age = null;
                    } else {
                        $child2_DOB = $crm->profile->child2_DOB;
                        $interval2 = date_diff(date_create(), date_create($child2_DOB));
                        $child2Age = $interval2->format("%yy, %mm, %dd");
                    }

                    if ($crm->profile->child3_DOB == null) {
                        $child3Age = null;
                    } else {
                        $child3_DOB = $crm->profile->child3_DOB;
                        $interval3 = date_diff(date_create(), date_create($child3_DOB));
                        $child3Age = $interval3->format("%yy, %mm, %dd");
                    }
                    if (isset($crm->brand->name)) {
                        $brandName = $crm->brand->name;
                    } else {
                        $brandName = null;
                    }

                    $data =  array($crm->id, $crm->phone_number,  $crm->profile->consumer_name, $crm->profile->consumer_age, $crm->profile->consumer_gender, $division, $district, $policeStation, $crm->profile->address, $crm->profile->alternative_phone_number, $crm->profile->profession, $crm->profile->sec, $crm->profile->number_of_child, $crm->profile->total_family_member, $child1Age, $child2Age, $child3Age, $crm->profile->prefered_brand, $brandName, $crm->product, $crm->competition_brand_usage, $crm->activity_campaign_name, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $crm->profile->agent, $crm->created_at);
                    array_push($arr, $data);
                }
                
                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Prefered Brand', 'Brand', 'Product', 'Com. Brand Usage', 'Act or Camp. Name', 'Source of Knowing', 'CCID', 'Sales Force', 'CSI', 'Interested CRM', 'Reasons', 'Category', 'Verbatim', 'Agent', 'Created At'
                    )
                );
            });
        })->export($type);
    }
}
