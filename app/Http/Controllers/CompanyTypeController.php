<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyType;
use App\Http\Requests\CompanyTypeRequest;
use DB;

class CompanyTypeController extends Controller
{
    //
  
    public function index()
    {
        try {
            $company = CompanyType::get();
        return view('company-type.index',['company_type'=>$company]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    public function create() 
    {
        try {
        return view('company-type.create');
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function store(CompanyTypeRequest $request)
    {
        try {
        DB::transaction(function () use ($request) {
        CompanyType::create_company_type($request);
        }); 
        return back();   
    } catch (\Exception $e) {
        return $e->getMessage();
      }     
    
    }
    public function edit(CompanyType $company_type) 
    {
  
        try {
            return view('company-type.edit', [
                'company' => $company_type
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }
    public function update(CompanyTypeRequest $request,CompanyType $company_type) {
   
        try {
           
            DB::transaction(function () use ($request,$company_type) {
                CompanyType::update_companytpe($request,$company_type);
        }); 
       return redirect()->route('company-type.index')->with('success','Company Type updated successfully');
    } catch (\Exception $e) {
        return $e->getMessage();
      }    
    }  
    public function destroy(CompanyType $company) 
    {
       
        try {
            DB::transaction(function () use ($company) {
            $company->delete();
        }); 
            return redirect()->route('company-type.index')->with('success','Copmany Type deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
          }
      
    }
}
