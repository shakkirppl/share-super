<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class Store extends Model
{
    protected $table = 'store';
    protected $fillable = ['id','code','name','comapny_id','logo','address','emirate','country','contact_number','whatsapp_number','email','username','password','no_of_partners','share_value','description','status'];
    use HasFactory,SoftDeletes;
    public static function create_store($request,$image)
    {
        $request['logo']=$image;
        $store=self::create($request->all());
        InvoiceNumber::updateinvoiceNumber('new_company_code',0);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->username,
            'password' => Hash::make($request->password),
            'is_shop_admin' => 1,
            'store_id'=>$store->id,
        ]);
       
        InvoiceNumber::create([
            'bill_type' => 'Receipt Voucher',
            'bill_mode' => 'receipt_voucher',
            'bill_no' => 0,
            'bill_prefix' => 'RV',
            'store_id'=>$store->id,
            'financial_year'=>1,
        ]);
      
        InvoiceNumber::create([
            'bill_type' => 'Payment Voucher',
            'bill_mode' => 'payment_voucher',
            'bill_no' => 0,
            'bill_prefix' => 'AP',
            'store_id'=>$store->id,
            'financial_year'=>1,
        ]);
        

    }
    public static function update_store($request,$store,$image)
    {
        $request['logo']=$image;
        $store->update($request->all());
    }
    public function scopeActive($query)
    {
         return $query->where('status',1)->orderBy('id', 'asc');
    }
    public function scopeDeactive($query)
    {
         return $query->where('status',0)->orderBy('id', 'asc');
    }

}
