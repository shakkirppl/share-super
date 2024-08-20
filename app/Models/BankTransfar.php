<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class BankTransfar extends Model
{
    protected $table = 'bank_transfer';
    protected $fillable = ['id','partner_id','month','in_date','in_time','amount','type','reference','document','status','description','user_id'];
    use HasFactory,SoftDeletes;
    public static function create_bank_transfar($request)
    {
        if($request->hasFile('document')){
            $document = $request->file('document');
            
                            $i='0';
           $randomId       =   rand(1,99999);
           $i++;
           
            $fileOriginalName = $document->getClientOriginalExtension();
           $fileNewName =$randomId.$i = time() .'.'. $fileOriginalName;
            $destinationPath = 'uploads/document';
           $document->move($destinationPath, $fileNewName, 'public'); //here image
          }
       
        $request['user_id']=Auth::user()->id;
        $request['in_time']=date('H:i:s');
        $invoice_no =  InvoiceNumber::ReturnInvoice('bank_transfar',0);
        $request['invoice_no']=$invoice_no;
        $request['document']=$fileNewName;
        $master=self::create($request->all());
        InvoiceNumber::updateinvoiceNumber('bank_transfar',0);

    }
   
    
      public function scopePartner($query,$partner_id)
     {
          return $query->where('partner_id',$partner_id);
     }
     public function partners(){
        
        return $this->hasMany(Partners::class,'id','partner_id');
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