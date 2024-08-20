<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyTypeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BankTransfarController;
use Barryvdh\DomPDF\Facade\Pdf;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/clear', function() {
    $exitCode = Artisan::call('cache:clear');
    // $exitCode = Artisan::call('route:cache');
    // $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');

    return '<h1>cleared</h1>';
});
Route::get('/', function () {
    return view('login');
});
Route::get('/generate-pdf', function () {
    $pdf = Pdf::loadHTML('<h1>Hello, World!</h1>');
return $pdf->download('test.pdf');

    $data = [
        'title' => 'Welcome to Laravel PDF',
        'date' => date('m/d/Y')
    ];

    $pdf = PDF::loadView('myPDF', $data);

    return $pdf->download('document.pdf');
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('dashboard', 'App\Http\Controllers\DashboardController@dashboard');
    Route::resource('company-type', CompanyTypeController::class);
    Route::resource('country', CountryController::class);
    Route::resource('province', ProvinceController::class);
    Route::resource('store', StoreController::class);
    Route::get('store-vew/{id}', [StoreController::class,'store_view'])->name('store.view');
    Route::get('store-active/{id}', [StoreController::class,'store_active']);
    Route::get('store-deactive/{id}', [StoreController::class,'store_deactive']);
    Route::get('active-store', [StoreController::class,'active_store']);
    Route::get('deactive-store', [StoreController::class,'deactive_store']);
    Route::resource('partners', PartnersController::class);
    Route::get('store.partners/{id}', [StoreController::class,'store_partners'])->name('store.partners');
    Route::get('/autocomplete', [PartnersController::class, 'autocomplete'])->name('autocomplete');
    Route::post('/store/partners', [StoreController::class, 'storePartners'])->name('store.partnters');

    Route::get('monthly-share-report-store-wise', [MainController::class,'monthly_share_report_store_wise'])->name('monthly-share-report-store-wise');
    Route::get('monthly-share-report-partner-wise', [MainController::class,'monthly_share_report_partner_wise'])->name('monthly-share-report-partner-wise');
    Route::get('monthly-share-report-partner-wise-generate-pdf', [MainController::class,'monthly_share_report_partner_wise_generate_pdf'])->name('monthly-share-report-partner-wise-generate-pdf');
    Route::resource('bank-transfer', BankTransfarController::class);
   
    
});

require __DIR__.'/auth.php';
