<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\DosenController;
use App\Http\Controllers\API\JadwalController;
use App\Http\Controllers\API\MahasiswaController;
use App\Http\Controllers\API\KelasController;
use App\Http\Controllers\API\PresensiController;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

/**
 * route "/register"
 * @method "POST"
 */
Route::post('/register', RegisterController::class)->name('register');

/**
 * route "/login"
 * @method "POST"
 */
Route::post('/login', LoginController::class)->name('login');

/**
 * route "/user"
 * @method "GET"
 */
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post("/logout", LogoutController::class)->name("logout");

//Admin
Route::get("/Dashboard-Admin", AdminController::class);

//Dosen / Kaprodi
Route::get("/Dashboard-Dosen-Profil", [DosenController::class, 'profilDosen']);
Route::get("/Dashboard-Dosen-Jadwal-Hari-Ini", [DosenController::class, 'jadwalHariIniDosen']);
Route::get("/Dashboard-Dosen-Konfirm-Mahasiswa", [DosenController::class, 'konfirmMahasiswa']);
Route::get('/Dashboard-Tolak-Surat', [DosenController::class, 'tolakSurat']);
Route::get("/Kelas-Data", [KelasController::class, 'dataKelasDosen']);
Route::get("/Kelas-Generate-Token-Kelas", [KelasController::class, 'generateTokenKelas']);
Route::get("/Kelas-Tabel-kelas-Dosen", [KelasController::class, 'kelasSaatIniDosen']);
Route::get("/Kelas-Edit-Kehadiran-Mahasiswa", [KelasController::class, 'editKehadiranMhs']);
Route::get("/Kelas-Tutup-Kelas", [KelasController::class, 'tutupKelas']);
Route::get("/Presensi-Dosen-Perminggu", [PresensiController::class, 'rekapPermingguDosen']);

//Mahasiswa
Route::get("/Dashboard-Mahasiswa", [MahasiswaController::class, 'profilMahasiswa']);
Route::get("/Dashboard-Mahasiswa-Konfirmasi-Kehadiran-Anda", [MahasiswaController::class, 'daftarKetidakhadiranMhs']);
Route::get("/Dashboard-Kirim-Surat", [MahasiswaController::class, 'kirimSuratKetidakhadiran']);
Route::post("/Kelas-Validasi-Token", [KelasController::class, 'checkTokenValid']);
Route::get("/Kelas-Mahasiswa", [KelasController::class, 'kelasSaatIniMahasiswa']);

//Jadwal
Route::get("/Dashboard-Mahasiswa-Jadwal-Harini", [MahasiswaController::class, 'jadwalHariIniMhs']);

//kelas
Route::get("/tabel-kelas", [KelasController::class, 'tableKelas']);
Route::put("/updatetable-Kelas/{id_kls}", [KelasController::class, 'updatetableKelas']);
Route::post("/createtable-Kelas", [KelasController::class, 'createtableKelas']);
Route::delete('/deletetable-Kelas/{id_kls}', [KelasController::class, 'deletetableKelas']);


//laporan
Route::get("/laporanmhs", [MahasiswaController::class , 'LaporanMhs']);
Route::get("/laporanmhsdosen", [MahasiswaController::class, 'LaporanMhsdosen']);