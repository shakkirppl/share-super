<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Store;
class DashboardController extends Controller
{
    //
    public function dashboard()
    {
        try {
             if(Auth::user()->is_super_admin==1){
            $name= Auth::user()->name;
            $total = Store::count();
            $active = Store::Active()->count();
            $deactive = Store::Deactive()->count();
 
            $recent_store=Store::select('id','name','created_at','status')->orderBy('id','DESC')->get();
            return view('admin',['now' => Carbon::now()->toDateString(),'name' => $name,'total'=>$total,'active'=>$active,'deactive'=>$deactive,'recent_store'=>$recent_store]);
        }
        else{
           Auth::guard('web')->logout(); 
           return redirect('/');
        }
    } catch (\Exception $e) {
        return $e->getMessage();
    }
    }
}
