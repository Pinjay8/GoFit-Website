<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\BookingGymController;
use App\Http\Controllers\PresensiInstrukturController;
use App\Http\Controllers\JadwalHarianController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware("auth:sanctum")->get("/user", function (Request $request) {
//     return $request->user();
// });

// Login dan Register
// Route::get("login", "App\Http\Controllers\LoginController@index");

Route::post("loginUser", "App\Http\Controllers\LoginController@login_process");
Route::post("loginUsers", "App\Http\Controllers\LoginController@loginUser");

Route::post(
    "gantiPassword",
    "App\Http\Controllers\LoginController@gantiPassword"
);

// Route::get("login", "App\Http\Controllers\LoginController@login_process");
// Route::post("register", "App\Http\Controllers\LoginController@register");

// Member
// Route::post(
//     "member/login_process",
//     "\App\Http\Controllers\LoginController@login_process"
// );
// Route::get("member", "\App\Http\Controllers\MemberController@indexMember");
// Route::get("member/{id}", "\App\Http\Controllers\MemberController@show");
// Route::post("member", "\App\Http\Controllers\MemberController@store");
// Route::put("member/{id}", "\App\Http\Controllers\MemberController@update");
// Route::delete(
//     "member/{id}",
//     "\App\Http\Controllers\MemberController@destroy"
// );
// Route::resource("izinInstruktur", \App\Http\Controllers\IzinController::class);

// Logout
Route::group(
    ["middleware" => "auth:pegawai-api,member-api,instruktur-api"],
    function () {
        Route::get(
            "izinInstruktur/{id}",
            "App\Http\Controllers\IzinController@getDataIzin"
        );
        Route::get(
            "dataJadwalHarian/{id}",
            "App\Http\Controllers\IzinController@getDataSchedule"
        );

        Route::get(
            "dataPresensi",
            "App\Http\Controllers\PresensiInstrukturController@index_api_presensi"
        );

        Route::get(
            "indexGym/{id}",
            "App\Http\Controllers\BookingGymController@indexBookingGym"
        );

        Route::post(
            "tambahPresensi",
            "App\Http\Controllers\PresensiInstrukturController@store"
        );

        Route::post(
            "tambahBooking",
            "App\Http\Controllers\BookingGymController@store"
        );

        Route::post(
            "tambahBookingKelas",
            "App\Http\Controllers\BookingKelasController@store"
        );

        Route::post("logout", "App\Http\Controllers\LoginController@logout");
    }
);

Route::post("tambahIzin", "App\Http\Controllers\IzinController@store");

Route::get(
    "dataBookingKelas/{id}",
    "App\Http\Controllers\BookingKelasController@getDataBooking"
);

Route::get(
    "dataJadwal",
    "App\Http\Controllers\JadwalHarianController@index_api"
);

Route::delete(
    "batalKelas/{id}",
    "App\Http\Controllers\BookingKelasController@cancelBooking"
);

Route::delete(
    "batalGym/{id}",
    "App\Http\Controllers\BookingGymController@batalGym"
);

Route::get(
    "dataMember/{id}",
    "App\Http\Controllers\MemberController@getDataMember"
);

Route::get(
    "dataInstruktur/{id}",
    "App\Http\Controllers\InstrukturController@getDataInstruktur"
);

Route::get(
    "dataKinerja/{id}",
    "App\Http\Controllers\InstrukturController@getAktivitasInstruktur"
);

Route::get(
    "instrukturPresensi/{id}",
    "App\Http\Controllers\BookingKelasController@indexPresensi"
);
Route::get(
    "memberPresensi/{id}",
    "App\Http\Controllers\BookingKelasController@indexHistoryPresensi"
);
Route::post(
    "updateTransaksi",
    "App\Http\Controllers\BookingKelasController@updateTransaksi"
);
