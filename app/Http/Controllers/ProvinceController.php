<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Country;
use App\Http\Requests\ProvinceRequest;
use DB;
class ProvinceController extends Controller
{
    //
    public function index()
    {
        try {
            $province = Province::with('country')->get();
        return view('province.index',['province'=>$province]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    public function create() 
    {
        try {
            $country = Country::get();
        return view('province.create',['country'=>$country]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function store(ProvinceRequest $request)
    {
        try {
        DB::transaction(function () use ($request) {
            Province::create_province($request);
        }); 
        return back();   
    } catch (\Exception $e) {
        return $e->getMessage();
      }     
    
    }
    public function edit(Province $province) 
    {
  
        try {
            $country = Country::get();
            return view('province.edit', [
                'country'=>$country,
                'province' => $province,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }
    public function update(ProvinceRequest $request,Province $province) {
   
        try {
           
            DB::transaction(function () use ($request,$province) {
                Province::update_province($request,$province);
        }); 
       return redirect()->route('province.index')->with('success','Province Type updated successfully');
    } catch (\Exception $e) {
        return $e->getMessage();
      }    
    }  
    public function destroy(Province $province) 
    {
       
        try {
            DB::transaction(function () use ($province) {
            $province->delete();
        }); 
            return redirect()->route('province.index')->with('success','Province Type deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
          }
      
    }
}
