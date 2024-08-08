<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Http\Requests\CountryRequest;
use DB;
class CountryController extends Controller
{
    //
    public function index()
    {
        try {
            $country = Country::get();
        return view('country.index',['country'=>$country]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    public function create() 
    {
        try {
        return view('country.create');
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function store(CountryRequest $request)
    {
        try {
        DB::transaction(function () use ($request) {
            Country::create_country($request);
        }); 
        return back();   
    } catch (\Exception $e) {
        return $e->getMessage();
      }     
    
    }
    public function edit(Country $country) 
    {
  
        try {
            return view('country.edit', [
                'country' => $country
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }
    public function update(CountryRequest $request,Country $country) {
   
        try {
           
            DB::transaction(function () use ($request,$country) {
                Country::update_country($request,$country);
        }); 
       return redirect()->route('country.index')->with('success','Country Type updated successfully');
    } catch (\Exception $e) {
        return $e->getMessage();
      }    
    }  
    public function destroy(Country $country) 
    {
       
        try {
            DB::transaction(function () use ($country) {
            $country->delete();
        }); 
            return redirect()->route('country.index')->with('success','Country Type deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
          }
      
    }
}
