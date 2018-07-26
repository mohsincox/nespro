<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Brand;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$brands = Brand::get();
    	return view('brand.index', compact('brands'));
    }

    public function create()
    {
    	return view('brand.create');
    }

    public function store(Request $request)
    {
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required|unique:brands'
	    ];
	    $messages = [
            'name.required' => 'The Brand Name field is required.',
            'name.unique' => 'The Brand Name already exist.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $brand = new Brand;
        $brand->name = $request->name;
        $brand->created_by = Auth::id();
        $brand->save();
        flash()->success($brand->name.' Brand Name created successfully');
    	return redirect('brand');
    }

    public function edit($id)
    {
    	$brand = Brand::find($id);
    	return view('brand.edit', compact('brand'));
    }
    
    public function update(Request $request, $id)
    {
    	$brand = Brand::find($id);
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required|unique:brands,name,'.$brand->id,
	    ];
	    $messages = [
            'name.required' => 'The Brand Name field is required.',
            'name.unique' => 'The Brand Name already exist.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $brand->name = $request->name;
        $brand->updated_by = Auth::id();
        $brand->save();
        flash()->success($brand->name.' Brand Name updated successfully');
    	return redirect('brand');
    }
}
