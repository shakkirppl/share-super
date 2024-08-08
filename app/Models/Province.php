<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
class Province extends Model
{
    protected $table = 'province';
    protected $fillable = ['id', 'name','country_id','status'];
    use HasFactory,SoftDeletes;
    public static function create_province($request)
    {
        self::create($request->all());
    }
    public static function update_province($request,$province)
    {
        $province->update($request->all());
    }
    public function scopeActive($query)
    {
         return $query->where('status',1)->orderBy('id', 'asc');
    }
    public function country(){
        
        return $this->hasMany(Country::class,'id','country_id');
     }
}
