<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\PeopleController;

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

Route::get('/', [PeopleController::class, 'index'])->name('people.index');


//provinsi
Route::get('/provinces', [ProvinceController::class, 'index'])->name('provinces.index');
Route::get('/provinces/create', [ProvinceController::class, 'create'])->name('provinces.create');
Route::post('/provinces', [ProvinceController::class, 'store'])->name('provinces.store');
Route::get('/provinces/{province}/edit', [ProvinceController::class, 'edit'])->name('provinces.edit');
Route::put('/provinces/{province}', [ProvinceController::class, 'update'])->name('provinces.update');
Route::delete('/provinces/{province}', [ProvinceController::class, 'destroy'])->name('provinces.destroy');

//kabupaten
Route::get('/districts', [DistrictController::class, 'index'])->name('districts.index');
Route::get('/districts/create', [DistrictController::class, 'create'])->name('districts.create');
Route::post('/districts', [DistrictController::class, 'store'])->name('districts.store');
Route::get('/districts/{district}/edit', [DistrictController::class, 'edit'])->name('districts.edit');
Route::put('/districts/{district}', [DistrictController::class, 'update'])->name('districts.update');
Route::delete('/districts/{district}', [DistrictController::class, 'destroy'])->name('districts.destroy');


//penduduk
Route::get('/peoples', [PeopleController::class, 'index'])->name('peoples.index');
Route::get('/peoples/create', [PeopleController::class, 'create'])->name('peoples.create');
Route::post('/peoples', [PeopleController::class, 'store'])->name('peoples.store');
Route::get('/peoples/{people}/edit', [PeopleController::class, 'edit'])->name('peoples.edit');
Route::put('/peoples/{people}', [PeopleController::class, 'update'])->name('peoples.update');
Route::delete('/peoples/{people}', [PeopleController::class, 'destroy'])->name('peoples.destroy');
Route::get('/get-districts/{province_id}', [PeopleController::class, 'getDistricts']);

Route::get('/people/per-province', [PeopleController::class, 'peoplePerProvince'])->name('people.per_province');
Route::get('/people/per-district', [PeopleController::class, 'peoplePerDistrict'])->name('people.per_district');
// Route::get('/people/export', [PeopleController::class, 'export'])->name('people.export');
Route::get('people/export/province/{province_id}', [PeopleController::class, 'peoplePerProvince'])->name('people.export.province');
Route::get('people/export/district/{district_id}', [PeopleController::class, 'peoplePerProvince'])->name('people.export.district');
