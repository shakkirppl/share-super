<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class PaymentVoucher extends Model
{
    protected $table = 'payment_voucher';
    protected $fillable = ['id','account_id', 'invoice_no','in_date','in_time','amount','vat_amount','total_amount','paid_amount','status','description','store_id','user_id'];
    use HasFactory,SoftDeletes;
    public static function create_payment_voucher($request)
    {
   
        $request['store_id']=Auth::user()->store_id;
        $request['user_id']=Auth::user()->id;
        $request['in_time']=date('H:i:s');
        $invoice_no =  InvoiceNumber::ReturnInvoice('payment_voucher',Auth::user()->store_id);
        $request['invoice_no']=$invoice_no;
        $master=self::create($request->all());
        InvoiceNumber::updateinvoiceNumber('payment_voucher',Auth::user()->store_id);

    }
    public function expense(){
       
        return $this->hasMany('App\Models\ExpenseMaster','id','account_id');
     }
     public function scopeStore($query)
     {
          return $query->where('store_id',Auth::user()->store_id);
     }
     
      public function scopeExpense($query,$expense)
     {
          return $query->where('expense_id',$expense);
     }
     public function store(){
        
        return $this->hasMany(Store::class,'id','store_id');
     }
   
     public function user(){
        
        return $this->hasMany(User::class,'id','user_id');
     }
     public function scopeIndate($query,$date)
     {
          return $query->where('in_date',$date);
     }
     public function scopeIntwodate($query,$from_date,$to_date)
      {
           return $query->where(function($query)use ($from_date,$to_date) {
                              if ($from_date && $to_date) {
                                  $query->whereBetween('in_date', [$from_date, $to_date]);
                              }
                               });
      } 
}
