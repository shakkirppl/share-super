<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class PartnerStore extends Model
{
    protected $table = 'partner_store';
    protected $fillable = [
        'store_id',
        'partner_id',
        'percentage',
        'share_value',
    ];
    use HasFactory,SoftDeletes;
   
    
    public function scopeActive($query)
    {
         return $query->where('status',1)->orderBy('id', 'asc');
    }
    public function scopeDeactive($query)
    {
         return $query->where('status',0)->orderBy('id', 'asc');
    }

}
