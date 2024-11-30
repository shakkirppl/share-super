<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
class ExpenseMaster extends Model
{
    protected $table = 'expense_master';
    protected $fillable = ['id', 'name','description','store_id'];
    use HasFactory,SoftDeletes;
    public static function create_expense($request)
    {
         $request['store_id']=Auth::user()->store_id;
        self::create($request->all());
    }
    public static function update_expense($request,$expensemaster)
    {
         $request['store_id']=Auth::user()->store_id;
        $expensemaster->update($request->all());
    }
   
    public function scopeStore($query)
    {
         return $query->where('store_id',Auth::user()->store_id);
    }
}
