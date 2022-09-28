<?php
use App\Http\Controllers\ShiftController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('shifts', [ShiftController::class,'index'])->name('shifts');
Route::get('createshift', [ShiftController::class, 'create']);
Route::post('shiftstore', [ShiftController::class,'store'])->name('shiftstore');

Route::get('/shifts/{shift_start}/{shift_end}', [ShiftController::class, 'timeslots']);