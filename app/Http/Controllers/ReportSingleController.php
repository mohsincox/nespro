<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Brand;
use App\Models\Division;

class ReportSingleController extends Controller
{
	public function __construct()
    {
    	$this->middleware('auth');
    }

    public function reportSingleFormExcel()
    {
    	$brandList = Brand::pluck('name', 'id');
        $divisionList = Division::pluck('name', 'id');

    	return view('report_single.form', compact('brandList', 'divisionList'));
    }

    public function reportSingleShowExcel(Request $request)
    {
    	return $request->all();
    }
}
