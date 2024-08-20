<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankTransfar;
use App\Models\Partners;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use DB;
class BankTransfarController extends Controller
{
    //

    public function index()
    {
        try {
            $payment = BankTransfar::with('partners')->get();
        return view('bank-transfer.index',['payment'=>$payment]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    public function create() 
    {
        try {
            $expense=Partners::get();
            $user=User::find(Auth::user()->id);
            $fromDate =$user->created_at;
            $toDate = Carbon::now();
            $start = Carbon::parse($fromDate)->startOfMonth();
            $end = Carbon::parse($toDate)->endOfMonth();
        
            $months = new Collection();
        
            while ($start->lte($end)) {
                $months->push($start->format('F Y')); // e.g., "January 2024"
                $start->addMonth();
            }
        return view('bank-transfer.create',['expense'=>$expense,'months'=>$months,]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function store(Request $request)
    {
      
        try {
    
          
        DB::transaction(function () use ($request) {
            BankTransfar::create_bank_transfar($request);
        }); 
        return back();   
    } catch (\Exception $e) {
        return $e->getMessage();
      }     
    
    }
    // public function edit(Category $category) 
    // {
  
    //     try {
    //         return view('category.edit', [
    //             'category' => $category
    //         ]);
    //     } catch (\Exception $e) {
    //         return $e->getMessage();
    //       }
    // }
    // public function update(Request $request,Category $category) {
   
    //     try {
           
    //         DB::transaction(function () use ($request,$category) {
    //             Category::update_category($request,$category);
    //     }); 
    //    return redirect()->route('category.index')->with('success','Category updated successfully');
    // } catch (\Exception $e) {
    //     return $e->getMessage();
    //   }    
    // }  
    public function destroy(BankTransfar $bank_transfer) 
    {
        try {
            DB::transaction(function () use ($bank_transfer) {
                $bank_transfer->delete();
            }); 
            return redirect()->route('bank-transfer.index')->with('success', 'Bank Transfer deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('bank-transfer.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    
    public function bank_transfer_report(Request $request)
    {
        
        try {
         
          $from_date=$request->from_date;
       $to_date=$request->to_date;
          $results = BankTransfar::with('user','partners')->Intwodate($from_date,$to_date)->Store()->orderBy('id','desc')->get();
            return view('bank-transfer.report',['results'=>$results]);

    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    
}
