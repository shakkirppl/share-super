<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
class Partners extends Model
{
    protected $table = 'partners';
    protected $fillable = ['id', 'name','code','main_image','address','contact_number','whatsapp_number','email','province_id','store_id','status'];
    use HasFactory,SoftDeletes;
    public static function create_data($request,$image)
    {
        $request['store_id']=Auth::user()->store_id;
         $request['main_image']=$image;
        self::create($request->all());
        InvoiceNumber::updateinvoiceNumber('partners_code_generation',Auth::user()->store_id);
    }
    public static function update_data($request,$prtner,$image)
    {
        $request['store_id']=Auth::user()->store_id;
          $request['main_image']=$image;
        $prtner->update($request->all());
    }
    public function scopeActive($query)
    {
         return $query->where('status',1)->orderBy('id', 'asc');
    }
    public function scopeStore($query)
    {
         return $query->where('store_id',Auth::user()->store_id);
    }
 
  
     public function province(){
        
        return $this->hasMany(Province::class,'id','province_id');
     }

}
