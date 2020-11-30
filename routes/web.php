<?php

use App\Http\Controllers\ImportController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ImportController::class, 'index'])->name('import.index');
Route::get('/export', [ImportController::class, 'export'])->name('file.export');
Route::get('/export-pdf', [ImportController::class, 'export_pdf'])->name('file.export.pdf');
Route::get('/qr-code', [ImportController::class, 'viewQr'])->name('view.qrcode');
Route::post('/import', [ImportController::class, 'import'])->name('file.import');
route::delete('/', [ImportController::class, 'deleteAll'])->name('file.deleteSelected');



// Route::get('/', [ImportController::class],'index');
