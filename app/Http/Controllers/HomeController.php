<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Models\Profile;
use App\Models\Crm;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Division;
use App\Models\District;
use App\Models\PoliceStation;

use Illuminate\Support\Facades\Auth;
//use Redirect;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $role = Auth::user()->role;
        if ($role == 'user') {
            //return Redirect::to('field-user/create');
            return redirect('field-user/create');
        }

        $todayStart = date('Y-m-d 00:00:00');
        $todayEnd = date('Y-m-d 23:59:59');
        $userCount = User::count();
        $profileTotalCount = Profile::count();
        $profileTodayCount = Profile::whereBetween('updated_at', [$todayStart, $todayEnd])->count();
        $crmTotalCount = Crm::count();
        $crmTodayCount = Crm::whereBetween('updated_at', [$todayStart, $todayEnd])->count();
        $brandCount = Brand::count();
        $productCount = Product::count();
        $divisionCount = Division::count();
        $districtCount = District::count();
        $policeStationCount = PoliceStation::count();

        return view('home', compact('userCount', 'profileTotalCount', 'profileTodayCount', 'crmTotalCount', 'crmTodayCount', 'brandCount', 'productCount', 'divisionCount', 'districtCount', 'policeStationCount'));
    }

    public function test()
    {
        return view('test');
    }

    public function test2(Request $request)
    {
        $dateOfBirth = $request->dateOfBirth2;
        return view('test2', compact('dateOfBirth'));
    }

    public function divisionDistrictShow(Request $request)
    {   
        $districts = District::where('division_id', $request->division_id)->get();
        foreach ($districts as $district) {
            $divWiseDistrictList[$district->id] = $district->name;
        }

        //print_r($divWiseDistrictList);
        return view('police_station.division_district', compact('divWiseDistrictList'));
    }
}
