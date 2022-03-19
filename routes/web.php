<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SemesterRegistrationController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\CouponController;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
{

    // one to one
    Route::get('/', [SemesterRegistrationController::class, 'indexOneToOne'])->name('semester.indexOneToOne');
    Route::post('/subscribeNewStudent', [RegisterController::class, 'subscribeNewStudent'])->name('semester.subscribeOneToOne');

    // get student info
    Route::get('/semester-registration/get-student-info', [SemesterRegistrationController::class, 'getStudentInfo'])->name('semester.registration.getStudentInfo');

    Route::get('/thank-you-page', [SemesterRegistrationController::class, 'thankYouPage'])->name('semester.thankYouPage');

    // import files to database
//    Route::get('/importCountries', [ImportController::class, 'importCountries']);
//    Route::get('/importStudents', [ImportController::class, 'importStudents']);

    // apply coupon
    Route::get('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('apply.coupon');
    Route::get('/thank-you', [SemesterRegistrationController::class, 'thankYouPage'])->name('semester.thankYouPage');

});

Route::get('/clear-cache', function() {
    Artisan::call('config:clear');
    echo "Cleared";
});

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('export-text-old', function (){
    $customers = \App\Models\Subscribe::query()->where('form_type', '=', 'stopped-students')->get();

    $content = [];
    foreach ($customers as  $customer) {
        $created_at_formatted = Carbon::parse($customer->created_at)->timezone('Asia/Riyadh')->format('Y-m-d');

        $content [] = $customer->reference_number ?? '-';
        $content [] = $created_at_formatted;
        $content [] = $customer->stoppedStudent->student->section ?? '-';
        $content [] = $customer->stoppedStudent->student->serial_number ?? '-';
        $content [] = $customer->stoppedStudent->student->name ?? '-';
        $content [] = $customer->stoppedStudent->favorite_time ?? '-';
        $content [] = $customer->stoppedStudent->bod ?? '-';
        $content [] = '-';
        $content [] = '-';
        $content [] = '-';
        $content [] = '-';
        $content [] = $customer->stoppedStudent->country->code ?? '-';
        $content [] = $customer->stoppedStudent->residenceCountry->code ?? '-';
        $content [] = $customer->stoppedStudent->city ?? '-';
        $content [] = $customer->stoppedStudent->address ?? '-';
        $content [] = $customer->stoppedStudent->postal_code ?? '-';
        $content [] = $customer->stoppedStudent->place_birth ?? '-';
        $content [] = $customer->stoppedStudent->id_number ?? '-';
        $content [] = $customer->stoppedStudent->father_whatsApp_number ?? '-';
        $content [] = $customer->stoppedStudent->mother_whatsApp_number ?? '-';
        $content [] = $customer->stoppedStudent->father_email ?? '-';
        $content [] = $customer->stoppedStudent->mother_email ?? '-';
        $content [] = $customer->stoppedStudent->preferred_language ?? '-';
        $content [] =  '-';
        $content [] =  '-';
        $content [] =  '-';
        $content [] =  '-';
        $content [] =  '-';
        $content [] =  '-';
        $content [] =  '-';
        $content [] =  '-';
        $content [] =  '-';
        $content [] =  '-';
    }

// file name to download
    $fileName = "contact_numbers.txt";

// make a response, with the content, a 200 response code and the headers
    return \Illuminate\Support\Facades\Response::json($content, 200, [
        'Content-type' => 'text/plain',
        'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
    ], JSON_UNESCAPED_UNICODE);

});

Route::get('export-text-new', function (){
    $customers = \App\Models\Subscribe::query()->where('form_type', '=', 'new-students')->get();


    $content = [];
    foreach ($customers as  $customer) {
        $created_at_formatted = Carbon::parse($customer->created_at)->timezone('Asia/Riyadh')->format('Y-m-d');

        $content [] = $customer->reference_number ?? '-';
        $content [] = $created_at_formatted;
        $content [] = $customer->newStudent->student->section ?? '-';
        $content [] = $customer->newStudent->student->serial_number ?? '-';
        $content [] = '-';
        $content [] = $customer->newStudent->favorite_time ?? '-';
        $content [] = $customer->newStudent->bod ?? '-';
        $content [] = $customer->newStudent->first_name ?? '-';
        $content [] = $customer->newStudent->father_name ?? '-';
        $content [] = $customer->newStudent->grandfather_name ?? '-';
        $content [] = $customer->newStudent->family_name ?? '-';
        $content [] = $customer->newStudent->country->code ?? '-';
        $content [] = $customer->newStudent->residenceCountry->code ?? '-';
        $content [] = $customer->newStudent->city ?? '-';
        $content [] = $customer->newStudent->address ?? '-';
        $content [] = $customer->newStudent->postal_code ?? '-';
        $content [] = $customer->newStudent->place_birth ?? '-';
        $content [] = $customer->newStudent->id_number ?? '-';
        $content [] = $customer->newStudent->father_whatsApp_number ?? '-';
        $content [] = $customer->newStudent->mother_whatsApp_number ?? '-';
        $content [] = $customer->newStudent->father_email ?? '-';
        $content [] = $customer->newStudent->mother_email ?? '-';
        $content [] = $customer->newStudent->preferred_language ?? '-';
        $content [] = $customer->newStudent->guardian_name ?? '-';
        $content [] = $customer->newStudent->guardian_work ?? '-';
        $content [] = $customer->newStudent->mother_name ?? '-';
        $content [] = $customer->newStudent->mother_work ?? '-';
        $content [] = $customer->newStudent->social_situation ?? '-';
        $content [] = is_null($customer->newStudent->current_disease) ? 'لا' : 'نعم';
        $content [] = $customer->newStudent->current_disease ?? '-';
        $content [] = is_null($customer->newStudent->name_school) ? 'لا' : 'نعم';
        $content [] = $customer->newStudent->name_school ?? '-';
        $content [] = is_null($customer->newStudent->studied_qaeedah) ? 'لا' : 'نعم';

    }

// file name to download
    $fileName = "contact_numbers.txt";

// make a response, with the content, a 200 response code and the headers
    return \Illuminate\Support\Facades\Response::json($content, 200, [
        'Content-type' => 'text/plain',
        'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
    ], JSON_UNESCAPED_UNICODE);

});
