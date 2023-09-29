<?php

use App\Http\Controllers\BookingKelasController;
use App\Http\Controllers\BookingGymController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InstrukturController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JadwalHarianController;
use App\Http\Controllers\TransaksiAktivasiController;
use App\Http\Controllers\TransaksiDepositUangController;
use App\Http\Controllers\TransaksiDepositKelasController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PresensiInstrukturController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
//     return view('index');

// });

// Auth::routes();

// Login
Route::get("/", [LoginController::class, "homepage"]);
// Route::get("login", [LoginController::class, "login"]);
// Route::post("login", [LoginController::class, "login_process"])->name(
//     "login.process"
// );

Route::controller(LoginController::class)->group(function () {
    Route::get("login", "login")->name("login");
    Route::post("login", "login_process")->name("login.process");
    Route::get("logout", "logout")->name("logout");
    Route::get("forgotPassword", "forgotPassword");
    Route::post("storeForgotPassword", "storeForgotPassword");
    Route::put("updateForgotPassword/{id}", "updateForgotPassword");
});

// Register
Route::get("register", [LoginController::class, "signup"])->name("register");
Route::post("register", [LoginController::class, "register"]);

Route::group(["middleware" => ["CheckLogin"]], function () {
    // Dashboard

    Route::controller(DashboardController::class)->group(function () {
        Route::get("dashboard/main", "index")->name("dashboard/main");
        // Member
        Route::controller(MemberController::class)->group(function () {
            Route::get("dashboard/memberDeaktif", "indexMemberDeaktif");
            Route::get("dashboard/memberDeaktifProcess", "deaktifProcess");

            Route::get("dashboard/resetKelas", "indexResetKelas");
            Route::get("dashboard/resetKelasProcess", "resetKelas");

            Route::get("dashboard/member", "index");
            Route::get("dashboard/searchMember", "search");
            Route::get("dashboard/cetakMember/{id}", "cetakCardMember");
            Route::get("dashboard/createMember", "create");
            Route::post("dashboard/storeMember", "store");
            Route::get("dashboard/editMember/{id}", "edit");
            Route::get("dashboard/resetPassword/{id}", "resetPassword");
            Route::put("dashboard/updateMember/{id}", "update");
            Route::delete("dashboard/destroy_member/{id}", "destroy");
        });
        Route::controller(InstrukturController::class)->group(function () {
            Route::get("dashboard/instruktur", "index");
            Route::get("dashboard/createInstruktur", "create");
            Route::post("dashboard/storeInstruktur", "store");
            Route::get("dashboard/editInstruktur/{id}", "edit");
            Route::put("dashboard/updateInstruktur/{id}", "update");
            Route::delete("dashboard/destroyInstruktur/{id}", "destroy");
            Route::get("dashboard/searchInstruktur", "search");
            Route::get("dashboard/resetIzin", "indexIzin");
            Route::get("dashboard/resetIzinProcess", "resetIzinProcess");
        });
        Route::controller(JadwalController::class)->group(function () {
            Route::get("dashboard/jadwal", "index");
            Route::get("dashboard/createJadwalUmum", "create");
            Route::post("dashboard/storeJadwalUmum", "store");
            Route::get("dashboard/editJadwalUmum/{id}", "edit");
            Route::put("dashboard/updateJadwalUmum/{id}", "update");
            Route::delete("dashboard/destroyJadwalUmum/{id}", "destroy");
        });
        Route::controller(JadwalHarianController::class)->group(function () {
            Route::get("dashboard/jadwalHarian", "index");
            Route::get(
                "dashboard/creategenerateJadwalHarian",
                "generateJadwalHarian"
            );
            Route::get("dashboard/editJadwalHarian/{id}", "edit");
            Route::put("dashboard/updateJadwalHarian/{id}", "update");
            Route::get("dashboard/searchJadwalHarian", "search");
        });
        Route::controller(TransaksiAktivasiController::class)->group(
            function () {
                Route::get("dashboard/transaksiAktivasi", "index");
                Route::get("dashboard/createTransaksiAktivasi", "create");
                Route::get("dashboard/cetakStruk/{id}", "cetakStrukAktivasi");
                Route::post("dashboard/storeTransaksiAktivasi", "store");
                Route::get("dashboard/indexAktivasi", "indexAktivasi");
            }
        );

        Route::controller(TransaksiDepositUangController::class)->group(
            function () {
                Route::get("dashboard/transaksiDepositUang", "index");
                Route::get(
                    "dashboard/cetakStrukUang/{id}",
                    "cetakStrukDepositReguler"
                );
                Route::get("dashboard/createTransaksiUang", "create");
                Route::post("dashboard/storeTransaksiUang", "store");

                Route::get("dashboard/inputDepositUang", "indexDepoUang");
            }
        );

        Route::controller(TransaksiDepositKelasController::class)->group(
            function () {
                Route::get("dashboard/transaksiDepositKelas", "index");
                Route::get(
                    "dashboard/cetakStrukKelas/{id}",
                    "cetakStrukDepositKelas"
                );
                Route::get("dashboard/createTransaksiKelas", "create");
                Route::post("dashboard/storeTransaksiKelas", "store");

                Route::get("dashboard/inputDepositKelas", "indexDepoKelas");
            }
        );

        Route::controller(IzinController::class)->group(function () {
            Route::get("dashboard/izinInstruktur", "index");
            Route::get("dashboard/editIzin/{id}", "edit");
            Route::put("dashboard/updateIzin/{id}", "update");
        });

        Route::controller(BookingKelasController::class)->group(function () {
            Route::get("dashboard/presensiBookingKelas", "index");
            Route::get(
                "dashboard/cetakStrukPresensiBooking/{id}",
                "cetakStrukPresensiBookingKelas"
            );
        });

        Route::controller(BookingGymController::class)->group(function () {
            Route::get("dashboard/presensiBookingGym", "index");
            Route::get(
                "dashboard/cetakStrukPresensiGym/{id}",
                "cetakStrukPresensiGym"
            );
            Route::get("dashboard/konfirmasiGym/{id}", "konfirmasiGym");
        });

        // add your all routes here to store session
        Route::controller(LaporanController::class)->group(function () {
            Route::get("dashboard/laporanPendapatan", "indexPendapatan");

            Route::get(
                "dashboard/laporanPendapatanProcess",
                "pendapatanProcess"
            );

            Route::get("dashboard/laporanAktivitasGym", "indexGym");

            Route::get("dashboard/laporanAktivitasGymProcess", "gymProcess");

            Route::get("dashboard/laporanAktivitasKelas", "indexKelas");

            Route::get(
                "dashboard/laporanAktivitasKelasProcess",
                "kelasProcess"
            );

            Route::get(
                "dashboard/laporanKinerjaInstruktur",
                "kinerjaInstrukturBulanan"
            );

            Route::get("dashboard/laporanInstruktur", "indexInstruktur");

            Route::get(
                "dashboard/laporanInstrukturProcess",
                "instrukturProcess"
            );

            // Route::get(
            //     "dashboard/cetakStrukPresensiGym/{id}",
            //     "cetakStrukPresensiGym"
            // );
        });
    });
});
