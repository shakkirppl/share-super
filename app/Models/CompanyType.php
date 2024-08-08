<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
class CompanyType extends Model
{
    protected $table = 'company_type';
    protected $fillable = ['id', 'name','status'];
    use HasFactory,SoftDeletes;
    public static function create_company_type($request)
    {
        $company = new self;
        $company->name = $request->name;
        $company->status = $request->status;
        $company->save();
    }
    public static function update_companytpe($request,$company)
    {
        $company->update($request->all());
    }
    public function scopeActive($query)
    {
         return $query->where('status',1)->orderBy('id', 'asc');
    }
}
