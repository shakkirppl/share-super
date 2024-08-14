<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Store;
use DB;
use App\Models\PaymentVoucher;
use App\Models\ReceiptVoucher;
use App\Models\PartnerStore;
use App\Models\Partners;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Artisan;
use Illuminate\Support\Collection;
class MainController extends Controller
{
    //
    
    
  
 public function monthly_share_report_store_wise(Request $request)
    {
        
        try {
          $user=User::find(Auth::user()->id);
          $store=Store::get();
          $fromDate =$user->created_at;

          
          $toDate = Carbon::now();
          $start = Carbon::parse($fromDate)->startOfMonth();
          $end = Carbon::parse($toDate)->endOfMonth();
      
          $months = new Collection();
      
          while ($start->lte($end)) {
              $months->push($start->format('F Y')); // e.g., "January 2024"
              $start->addMonth();
          }
          $month = $request->month;
        $stores=[];
// Get the start date of the month
      $startDate = Carbon::parse($month)->startOfMonth()->toDateString();

// Get the end date of the month
      $endDate = Carbon::parse($month)->endOfMonth()->toDateString();
      foreach($store as $stor)
      { 
      $income=ReceiptVoucher::where('store_id',$stor->id)->WhereBetween('in_date',[$startDate,$endDate])->sum('total_amount');
      $expense=PaymentVoucher::where('store_id',$stor->id)->WhereBetween('in_date',[$startDate,$endDate])->sum('total_amount');
      $profit=$income-$expense;
      $storeData[] = [
        'name' => $stor->name,
        'income' => $income,
        'expense' => $expense,
        'profit' => $profit,
    ];
      }

   
      return view('reports.monthly-share',['months'=>$months, 'stores' => $storeData,'month'=>$month]);

    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function monthly_share_report_partner_wise(Request $request)
    {
        
        try {
          $user=User::find(Auth::user()->id);
          $store=Store::get();
          $partners=Partners::get();
          $fromDate =$user->created_at;
          $toDate = Carbon::now();
          $start = Carbon::parse($fromDate)->startOfMonth();
          $end = Carbon::parse($toDate)->endOfMonth();
      
          $months = new Collection();
      
          while ($start->lte($end)) {
              $months->push($start->format('F Y')); // e.g., "January 2024"
              $start->addMonth();
          }
          $month = $request->month;
          $partner_id = $request->partner_id;
          
        $stores=[];
// Get the start date of the month
      $startDate = Carbon::parse($month)->startOfMonth()->toDateString();

// Get the end date of the month
      $endDate = Carbon::parse($month)->endOfMonth()->toDateString();
      $partnerDetail=[];
      if($partner_id){
      foreach($store as $stor)
      { 
      $income=ReceiptVoucher::where('store_id',$stor->id)->WhereBetween('in_date',[$startDate,$endDate])->sum('total_amount');
      $expense=PaymentVoucher::where('store_id',$stor->id)->WhereBetween('in_date',[$startDate,$endDate])->sum('total_amount');
      $profit=$income-$expense;
     
      $invest_detail=PartnerStore::where('partner_id',$partner_id)->where('store_id',$stor->id)->first();
      if($invest_detail){
      $partnerDetail[] = [
        'name' => $stor->name,
        'percentage' => $invest_detail->percentage,
        'profit' => ($profit*$invest_detail->percentage)/100,
    ];
      }
    }
    }

   
      return view('reports.monthly-share-partners',['months'=>$months, 'partnerDetail' => $partnerDetail,'month'=>$month,'partners'=>$partners]);

    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    
      
 public function monthly_report_detail($month)
 {
     
     try {
       $store=Store::find(Auth::user()->store_id);


// Get the start date of the month
   $startDate = Carbon::parse($month)->startOfMonth()->toDateString();

// Get the end date of the month
   $endDate = Carbon::parse($month)->endOfMonth()->toDateString();
   $receipt=ReceiptVoucher::with('receipt')->Store()->WhereBetween('in_date',[$startDate,$endDate])->get();
   $payment=PaymentVoucher::with('expense')->Store()->WhereBetween('in_date',[$startDate,$endDate])->get();

   $partnerStore=PartnerStore::with('partner')->where('store_id',$store->id)->get();
   return view('reports.monthly-report-detail',['receipt'=>$receipt,'payment'=>$payment,'month'=>$month]);

 } catch (\Exception $e) {
     return $e->getMessage();
   }
 }
    
                   
      
    
}
