<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyType;
use App\Models\Store;
use App\Models\Partners;
use App\Models\Province;
use App\Models\PartnerStore;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\StoreUpdateRequest;
use DB;
use Carbon\Carbon;
use App\Helper\File;
use App\Models\InvoiceNumber;
class StoreController extends Controller
{
    use File;
    //
    public function invoice_no(){
        try {
             
                  return $invoice_no =  InvoiceNumber::ReturnInvoice('new_company_code',0);
                  } catch (\Exception $e) {
         
            return $e->getMessage();
          }
                 }
    public function index()
    {
        try {
            $store = Store::get();
        return view('store.index',['store'=>$store]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    public function create() 
    {
        try {
            
            $province=Province::get();
            $CompanyType=CompanyType::Active()->get();
        return view('store.create',['company'=>$CompanyType,'code'=>$this->invoice_no(),'province'=>$province]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function store(StoreRequest $request)
    {
        try {
            if( $file = $request->file('image') ) {
                $path = 'uploads/store';
                $image = $this->file($file,$path,150,150);
            }else{$image='defalut.jpg';}
        DB::transaction(function () use ($request,$image) {
            Store::create_store($request,$image);
        }); 
        return back();   
    } catch (\Exception $e) {
        return $e->getMessage();
      }     
    
    }
    public function edit(Store $store) 
    {
  
        try {
            $province=Province::get();
            $CompanyType=CompanyType::Active()->get();
            return view('store.edit', [
                'store' => $store,'company'=>$CompanyType,'province'=>$province
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }
    public function update(StoreUpdateRequest $request,Store $store) {
   
        try {
            if( $file = $request->file('image') ) {
                $path = 'uploads/store';
                $image = $this->file($file,$path,150,150);
            }else{$image=$store->logo;}
            DB::transaction(function () use ($request,$store,$image) {
                Store::update_store($request,$store,$image);
        }); 
       return redirect()->route('store.index')->with('success','Store updated successfully');
    } catch (\Exception $e) {
        return $e->getMessage();
      }    
    }  
    public function store_partnters(Request $request) {
   
        try {
           return $request->all();
            if( $file = $request->file('image') ) {
                $path = 'uploads/store';
                $image = $this->file($file,$path,150,150);
            }else{$image=$store->logo;}
            DB::transaction(function () use ($request,$store,$image) {
                Store::update_store($request,$store,$image);
        }); 
       return redirect()->route('store.index')->with('success','Store updated successfully');
    } catch (\Exception $e) {
        return $e->getMessage();
      }    
    } 
    
    public function destroy(Store $store) 
    {
       
        try {
            DB::transaction(function () use ($store) {
            $store->delete();
        }); 
            return redirect()->route('store.index')->with('success','Store deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
          }
      
    }
    public function store_view( $id) 
    {
  
        try {
            
            $store=Store::find($id);
           
            
            // $pending_days=Carbon::now()->subDays(7)->toDateString();
            return view('store.view', [
                'store' => $store
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }
    public function store_active( $id) 
    {
  
        try {
            $store=Store::find($id);
            $store->status=1;
            $store->save();
            return back();
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }
    public function store_deactive( $id) 
    {
  
        try {
            $store=Store::find($id);
            $store->status=0;
            $store->save();
            return back();
            
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }

 
    public function active_store()
    {
        try {
            $store = Store::Active()->get();
        return view('store.index',['store'=>$store]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function deactive_store()
    {
        try {
            $store = Store::Deactive()->get();
        return view('store.index',['store'=>$store]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function store_partners($id)
    {
        try {
            $store = Store::find($id);
            $partners=Partners::get();
        return view('store.partners',['store'=>$store,'partners'=>$partners]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function storePartners(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'store_id' => 'required|exists:store,id',
            'partners_id' => 'required|array',
            'partners_id.*' => 'required|exists:partners,id',
            'percentage' => 'required|array',
            'percentage.*' => 'required|numeric|min:0|max:100',
            'share_value' => 'required|array',
            'share_value.*' => 'required|numeric|min:0',
        ]);
        DB::transaction(function () use ($request) {
        // Clear existing partners for the store
        PartnerStore::where('store_id', $request->store_id)->delete();

        // Loop through partners and save to the database
        foreach ($request->partners_id as $index => $partnerId) {
            PartnerStore::create([
                'store_id' => $request->store_id,
                'partner_id' => $partnerId,
                'percentage' => $request->percentage[$index],
                'share_value' => $request->share_value[$index],
            ]);
        }
    }); 
        return redirect('store')->with('success', 'Partners updated successfully!');
    }
    
    
}
