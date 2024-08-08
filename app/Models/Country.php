<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
class Country extends Model
{
    protected $table = 'country';
    protected $fillable = ['id', 'name','status'];
    use HasFactory,SoftDeletes;
    public static function create_country($request)
    {
        $country = new self;
        $country->name = $request->name;
        $country->status = $request->status;
        $country->save();
    }
    public static function update_country($request,$country)
    {
        $country->update($request->all());
    }
    public function scopeActive($query)
    {
         return $query->where('status',1)->orderBy('id', 'asc');
    }
}
