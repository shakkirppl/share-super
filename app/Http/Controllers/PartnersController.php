<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\Partners;
use App\Models\Province;
use App\Http\Requests\PartnersRequest;
use DB;
use App\Models\InvoiceNumber;
use Illuminate\Support\Facades\Auth;
use App\Helper\File;
class PartnersController extends Controller
{
    //
       use File;
        public function invoice_no(){
        try {
             
         return $invoice_no =  InvoiceNumber::ReturnInvoice('partners_code_generation',Auth::user()->store_id);
                  } catch (\Exception $e) {
         
            return $e->getMessage();
          }
                 }
    public function index()
    {
        try {
            $results = Partners::with('province')->get();
           
        return view('partners.index',['results'=>$results]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    public function create() 
    {
        try {
            $province=Province::get();
        return view('partners.create',['province'=>$province,'invoice_no'=>$this->invoice_no()]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function store(PartnersRequest $request)
    {
      
        try {
                 if( $file = $request->file('image') ) {
                $path = 'uploads/partners';
                $image = $this->file($file,$path,150,150);
            }else{$image='defalut.jpg';}

        DB::transaction(function () use ($request,$image) {
            Partners::create_data($request,$image);
        }); 
        return back();   
    } catch (\Exception $e) {
        return $e->getMessage();
      }     
    
    }
    public function edit(Partners $partner) 
    {
 
        try {
            $province=Province::get();
            return view('partners.edit', [
                'partner' => $partner,
                'province'=>$province
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }
    public function update(Request $request,Partners $partner) {
   
        try {
                      if( $file = $request->file('image') ) {
                $path = 'uploads/partners';
                $image = $this->file($file,$path,150,150);
            }else{$image=$partner->image;}
            DB::transaction(function () use ($request,$partner,$image) {
                Partners::update_data($request,$partner,$image);
        }); 
       return redirect()->route('partners.index')->with('Success','Partners updated successfully');
    } catch (\Exception $e) {
        return $e->getMessage();
      }    
    }  
    public function destroy(Partners $partner) 
    {
        try {
            DB::transaction(function () use ($partner) {
            $partner->delete();
        }); 
            return redirect()->route('partners.index')->with('success','Partners deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
          }
      
    }
    public function autocomplete(Request $request)
    {
        $search = $request->get('term');

        $partners = Partners::where('name', 'LIKE', '%' . $search . '%')
            ->get(['id', 'name','code']);

        $results = [];

        foreach ($partners as $partner) {
            $results[] = [
                'id' => $partner->id,
                'value' => $partner->name,
                'code'=>$partner->code,
            ];
        }

        return response()->json($results);
    }
}
