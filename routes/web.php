<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\KasirController;


Route::get('/', function () {
    return view('auth.login');
});

        //AUTH
Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/registerr', fn() => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth']], function(){
    Route::get('/verify', [VerificationController::class, 'index']);
    Route::post('/verify', [VerificationController::class, 'store']);
    Route::get('/verify/{unique_id}', [VerificationController::class, 'show']);
    Route::put('/verify/{unique_id}', [VerificationController::class, 'update']);
});

        //FITUR CUSTOMER
Route::group(['middleware' => ['auth', 'check_role:customer']], function(){
    Route::get('/customer', fn () => view('customer.customer'));
});

Route::group(['middleware' => ['auth', 'check_role:admin,staff,customer']], function(){
    Route::get('/dashboard', [DashboardController::class, 'index']);
});


        //FITUR ADMIN
Route::group(['middleware' => ['auth', 'check_role:admin']], function(){
    Route::get('/buat-akun-karyawan', [KaryawanController::class, 'create'])->name('karyawan.create');
    Route::post('/buat-akun-karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');
    Route::get('/detailPenjualan', fn () => 'detailPenjualan');

    // Barang Routes
    Route::get('/tampil-barang', [BarangController::class, 'tampilBarang'])->name('tampil-barang');
    Route::get('/tambah-barang', [BarangController::class, 'formTambahBarang'])->name('barang.create');
    Route::post('/tambah-barang', [BarangController::class, 'tambahBarang'])->name('tambah-barang');
    Route::get('/edit-barang/{id}', [BarangController::class, 'ShowEditBarang'])->name('barang.edit');
    Route::put('/edit-barang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/hapus-barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

    // Menampilkan daftar karyawan
    Route::get('dataKaryawan', [KaryawanController::class, 'dataKaryawan'])->name('data-karyawan');
    Route::get('inputKaryawan', [KaryawanController::class, 'FormInputKaryawan'])->name('karyawan.create');
    Route::post('tambahKaryawan', [KaryawanController::class, 'InputKaryawan'])->name('karyawan.store');
    Route::get('editKaryawan/{id}', [KaryawanController::class, 'FormEditKaryawan'])->name('karyawan.edit');
    Route::put('updateKaryawan/{id}', [KaryawanController::class, 'updateKaryawan'])->name('karyawan.update');
    Route::delete('hapusKaryawan/{id}', [KaryawanController::class, 'hapusKaryawan'])->name('karyawan.destroy');

});

    //FITUR STAAFF
Route::group(['middleware' => ['auth', 'check_role:staff']], function(){
    Route::get('data-member', [MemberController::class, 'dataMember'])->name('data-member');
    Route::get('/buat-akun-member', [MemberController::class, 'create'])->name('member.create');
    Route::post('/buat-akun-member', [MemberController::class, 'store'])->name('member.store');
    Route::get('/edit-member/{id}', [MemberController::class, 'FormEditMember'])->name('member.edit');
    Route::put('update-member/{id}', [MemberController::class, 'updateMember'])->name('member.update');
    Route::delete('hapus-member/{id}', [MemberController::class, 'hapusMember'])->name('member.destroy');

    //kasir
    Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
    Route::post('/kasir/proses', [KasirController::class, 'prosesTransaksi'])->name('kasir.proses');
    Route::get('/kasir/search', [KasirController::class, 'searchBarang'])->name('kasir.search');

});



Route::get('/logout', [AuthController::class, 'logout']);
