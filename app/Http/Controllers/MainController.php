<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Store;
use DB;
use App\Models\PaymentVoucher;
use App\Models\ReceiptVoucher;
use App\Models\PartnerStore;
use App\Models\BankTransfar;
use App\Models\Partners;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Artisan;
use Illuminate\Support\Collection;
use PDF;
use ZipArchive;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class MainController extends Controller
{
    //
    
    
  
 public function monthly_share_report_store_wise(Request $request)
    {
      // return $request->all();
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

 
      return view('reports.monthly-share',['months'=>$months, 'stores' => $storeData,'selectmonth'=>$month]);

    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function monthly_share_report_partner_wise(Request $request)
    {
    // return $request->all();
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
          
          if($month)
          {
            
        $stores=[];
// Get the start date of the month
      $startDate = Carbon::parse($month)->startOfMonth()->toDateString();

// Get the end date of the month
      $endDate = Carbon::parse($month)->endOfMonth()->toDateString();
      $partnerDetail=[];
      $partnerStore=PartnerStore::with('partnr','store')->Partner($partner_id)->get();
      foreach($partnerStore as $partner)
      { 
      $income=ReceiptVoucher::where('store_id',$partner->store_id)->WhereBetween('in_date',[$startDate,$endDate])->sum('total_amount');
      $expense=PaymentVoucher::where('store_id',$partner->store_id)->WhereBetween('in_date',[$startDate,$endDate])->sum('total_amount');
      $profit=$income-$expense;
     
      $invest_detail=PartnerStore::Partner($partner->partner_id)->where('store_id',$partner->store_id)->first();
      if($invest_detail){
        $partnerName = $partner->partnr ? $partner->partnr->name : 'Unknown Partner';
        $storeName = $partner->store ? $partner->store->name : 'Unknown Store';
      //   foreach($partner->store as $stor)
      // { 
        
      //   $storeName=$stor->name;
      // }
      // foreach($partner->partnr as $partn)
      // { 
      
      //   $partnerName=$partn->name;
      // }
        
      $partnerDetail[] = [
        'name' => $storeName,
        'partnername' => $partnerName,
        'percentage' => $invest_detail->percentage,
        'profit' => ($profit*$invest_detail->percentage)/100,
    ];
      }
    }
  }
  else{
    $partnerDetail=[];
    $partners=[];
    $month='';
  }
 

   
      return view('reports.monthly-share-partners',['months'=>$months, 'partnerDetail' => $partnerDetail,'selectmonth'=>$month,'partners'=>$partners]);

    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    // public function monthly_share_report_partner_wise_generate_pdf(Request $request)
    // {
    //     try {
    //         $month = $request->select_month;
    //         $directoryPath = storage_path('app/public/reports');
    
    //         if ($month) {
    //             $startDate = Carbon::parse($month)->startOfMonth()->toDateString();
    //             $endDate = Carbon::parse($month)->endOfMonth()->toDateString();
    
    //             // Create the directory if it doesn't exist
    //             if (!File::exists($directoryPath)) {
    //                 File::makeDirectory($directoryPath, 0755, true);
    //             }
    
    //             // Initialize ZIP file
    //             $zip = new ZipArchive;
    //             $zipFileName = 'monthly_share_reports_' . $month . '.zip';
    //             $zipFilePath = $directoryPath . '/' . $zipFileName;
    
    //             if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
    //               $partners=Partners::get();
    //               foreach ($partners as $part) {
    //                 $partnerStores = PartnerStore::with('store')->where('partner_id',$part->id)->get(); 
    //                 foreach ($partnerStores as $partner) {
    //                   $income = ReceiptVoucher::where('store_id', $partner->store_id)
    //                   ->whereBetween('in_date', [$startDate, $endDate])
    //                   ->sum('total_amount');

    //                 $expense = PaymentVoucher::where('store_id', $partner->store_id)
    //                    ->whereBetween('in_date', [$startDate, $endDate])
    //                    ->sum('total_amount');

    //               $profit = $income - $expense;

    //                 $invest_detail = PartnerStore::where('partner_id', $partner->partner_id)
    //                        ->where('store_id', $partner->store_id)
    //                        ->first();
    //                        if ($invest_detail) {
    //                         $data[] = [
    //                           'title' => 'Monthly Share Report',
    //                           'date' => Carbon::now()->format('m/d/Y'),
    //                           'store_name' => 'test',
    //                           'percentage' => $invest_detail->percentage,
    //                           'profit' => ($profit * $invest_detail->percentage) / 100,
    //                       ];
    //                        }
    //                 }
    //                 return view('pdf.monthly_share_report', ['data'=>$data]);
    //                 $pdf = PDF::loadView('pdf.monthly_share_report', $data);
    //                  // Generate a temporary file for this PDF
    //                  $fileName = 'monthly_share_report_' . $partnerName . '_' . $storeName . '.pdf';
    //                  $tempFilePath = $directoryPath . '/' . $fileName;
    //                  $pdf->save($tempFilePath);

    //                  // Add the PDF to the ZIP
    //                  $zip->addFile($tempFilePath, $fileName);
    //                 // return  $data;
    //               }
    //               $zip->close();
      
    //                 // Return the ZIP file for download
    //                 return response()->download($zipFilePath)->deleteFileAfterSend(true);
    //             } else {
    //                 return back()->with('error', 'Failed to create ZIP file.');
    //             }
    //         } else {
    //             return back()->with('error', 'Month is required.');
    //         }
    //     } catch (\Exception $e) {
    //         return $e->getMessage();
    //     }
    // }
    
    public function monthly_share_report_partner_wise_generate_pdf(Request $request)
    {
        try {
        //  return $request->all();
            $month = $request->select_month;
            $directoryPath = storage_path('app/public/reports');
            $selectedmonth = $request->select_month;
            if ($month) {
                $startDate = Carbon::parse($month)->startOfMonth()->toDateString();
                $endDate = Carbon::parse($month)->endOfMonth()->toDateString();
                if (preg_match('/^(\w+)\s(\d{4})$/', $month, $matches)) {
                  $month = $matches[1]; // "August"
                  $year = $matches[2];  // "2024"
              } else {
                  return response()->json(['error' => 'Invalid date format'], 400);
              }
                // Create the directory if it doesn't exist
                if (!File::exists($directoryPath)) {
                    File::makeDirectory($directoryPath, 0755, true);
                }
    
                // Initialize ZIP file
                $zip = new ZipArchive;
                $zipFileName = 'monthly_share_reports_' . $month . '.zip';
                $zipFilePath = $directoryPath . '/' . $zipFileName;
    
                if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
                    $partners = Partners::get();
    
                    foreach ($partners as $partner) {
                        $data = []; // Initialize data array for each partner
                        $partnerStores = PartnerStore::with('store')->where('partner_id', $partner->id)->get();
    $partnerName=$partner->name;
    $contact_number=$partner->contact_number;
                        foreach ($partnerStores as $store) {
                            $income = ReceiptVoucher::where('store_id', $store->store_id)
                                ->whereBetween('in_date', [$startDate, $endDate])
                                ->sum('total_amount');
    
                            $expense = PaymentVoucher::where('store_id', $store->store_id)
                                ->whereBetween('in_date', [$startDate, $endDate])
                                ->sum('total_amount');
    
                            $profit = $income - $expense;
    
                            $invest_detail = PartnerStore::where('partner_id', $partner->id)
                                ->where('store_id', $store->store_id)
                                ->first();
                                $transfer=BankTransfar::where('month',$selectedmonth)->where('partner_id',$partner->id)->get();
                            if ($invest_detail) {
                                $data[] = [
                                    'title' => 'Monthly Share Report',
                                    'date' => $endDate,
                                    'year'=>$year,
                                    'store_name' => $store->store->name,
                                    'percentage' => $invest_detail->percentage,
                                    'profit' => ($profit * $invest_detail->percentage) / 100,
                                ];
                            }
                        }
                        // change start
                        
                        // change end
                        //  return view('pdf.monthly_share_report',['data'=>$data,'month'=>$month,'year'=>$year,'partnerName'=>$partnerName,'contact_number'=>$contact_number,'transfer'=>$transfer,'endDate'=>$endDate]);
                        if (!empty($data)) {
                            $pdf = PDF::loadView('pdf.monthly_share_report', ['data' => $data,'month'=>$month,'year'=>$year,'partnerName'=>$partnerName,'contact_number'=>$contact_number,'transfer'=>$transfer,'endDate'=>$endDate]);
                            $fileName = 'monthly_share_report_' . $partner->name . '.pdf';
                            $tempFilePath = $directoryPath . '/' . $fileName;
                            $pdf->save($tempFilePath);
    
                            // Add the PDF to the ZIP
                            $zip->addFile($tempFilePath, $fileName);
                        }
                    }
    
                    $zip->close();
    
                    // Return the ZIP file for download
                    return response()->download($zipFilePath)->deleteFileAfterSend(true);
                } else {
                    return back()->with('error', 'Failed to create ZIP file.');
                }
            } else {
                return back()->with('error', 'Month is required.');
            }
        } catch (\Exception $e) {
            return response()->json(['data' => [], 'success' => false, 'messages' => [$e->getMessage()]]);
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
   return view('reports.monthly-report-detail',['receipt'=>$receipt,'payment'=>$payment,'selectmonth'=>$month]);

 } catch (\Exception $e) {
     return $e->getMessage();
   }
 }
    
                   
      
    
}
