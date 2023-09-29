<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instruktur;
use App\Models\JadwalUmum;
use App\Models\JadwalHarian;
use App\Models\PresensiInstruktur;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

class JadwalHarianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwalHarian = JadwalHarian::where(
            "TGL_EXPIRED",
            ">=",
            Carbon::now()->format("Y-m-d")
        )
            ->orderBy("TANGGAL_HARIAN", "asc")
            ->get();
        $tanggalJadwalHarian = JadwalHarian::where(
            "TGL_EXPIRED",
            ">=",
            Carbon::now()->format("Y-m-d")
        )->first();

        return view("jadwal_harian/index")->with([
            "user" => Auth::guard("pegawai")->user(),
            "jadwalHarians" => $jadwalHarian,
            "tanggalHarian" => $tanggalJadwalHarian,
        ]);
    }

    public function index_api(Request $request)
    {
        if ($request->expectsjson()) {
            $schedule_daily = DB::table("jadwal_harian as jh")
                ->select(
                    "jh.TANGGAL_HARIAN",
                    "i.NAMA_INSTRUKTUR",
                    "k.NAMA_KELAS",
                    "ju.ID_KELAS",
                    "jh.STATUS_JADWAL_HARIAN",
                    "ju.HARI_JADWAL_UMUM",
                    "k.TARIF_KELAS"
                )
                ->join("instruktur as i", "jh.ID_INSTRUKTUR", "i.ID_INSTRUKTUR")
                ->join(
                    "jadwal_umum as ju",
                    "jh.ID_JADWAL_UMUM",
                    "ju.ID_JADWAL_UMUM"
                )
                ->join("kelas as k", "ju.ID_KELAS", "k.ID_KELAS")
                ->where("jh.TANGGAL_HARIAN", ">", Carbon::now())
                ->orderby("jh.TANGGAL_HARIAN", "asc")
                ->get();
            if ($schedule_daily) {
                return response(
                    [
                        "message" => "Successfully get data schedule",
                        "data" => $schedule_daily,
                    ],
                    200
                );
            }
            return response(
                [
                    "message" => "Successfully get data permission",
                    "data" => null,
                ],
                400
            );
        }
    }

    public function generateJadwalHarian()
    {
        $jadwalUmum = JadwalUmum::all();
        // $tanggal_harian = JadwalHarian::first();

        $cekGenerate = JadwalHarian::where(
            "TGL_EXPIRED",
            ">=",
            Carbon::now()->format("Y-m-d")
        )
            ->latest("TGL_EXPIRED")
            ->first();

        // if (JadwalHarian::exists() || $cekGenerate) {
        //     return redirect()
        //         ->intended("dashboard/jadwalHarian")
        //         ->with([
        //             "error" =>
        //                 "Jadwal harian sudah digenerate dan bisa digenerate lagi setelah tanggal expired" .
        //                 $tanggal_harian->TGL_EXPIRED,
        //         ]);
        // } else {
        //     JadwalHarian::truncate();

        //     for (
        //         $i = Carbon::now();
        //         $i <= Carbon::now()->addDays(6);
        //         $i->modify("+1 day")
        //     ) {
        //         $day = Carbon::createFromFormat(
        //             "Y-m-d H:i:s",
        //             $i
        //         )->translatedformat("l");
        //         foreach ($jadwalUmum as $item) {
        //             if ($day == $item->HARI_JADWAL_UMUM) {
        //                 $daily = JadwalHarian::create([
        //                     "TANGGAL_HARIAN" =>
        //                         $i->format("Y-m-d") .
        //                         " " .
        //                         $item->WAKTU_JADWAL_UMUM,
        //                     "ID_JADWAL_UMUM" => $item->ID_JADWAL_UMUM,
        //                     "ID_INSTRUKTUR" => $item->ID_INSTRUKTUR,
        //                     "STATUS_JADWAL_HARIAN" => "-",
        //                     "TGL_EXPIRED" => Carbon::now()
        //                         ->addDays(6)
        //                         ->format("Y-m-d H:i:s"),
        //                 ]);
        //             }
        //         }
        //     }

        if ($cekGenerate) {
            return redirect()
                ->intended("dashboard/jadwalHarian")
                ->with([
                    "error" =>
                        "Jadwal harian sudah digenerate dan bisa digenerate lagi setelah tanggal expired" .
                        $cekGenerate->TGL_EXPIRED,
                ]);
        } else {
            // DailySchedule::truncate();
            $expired = Carbon::now()
                ->addDays(6)
                ->format("Y-m-d H:i:s");
            for (
                $i = Carbon::now();
                $i <= Carbon::now()->addDays(6);
                $i->modify("+1 day")
            ) {
                $day = Carbon::createFromFormat(
                    "Y-m-d H:i:s",
                    $i
                )->translatedformat("l");
                foreach ($jadwalUmum as $item) {
                    if ($day == $item->HARI_JADWAL_UMUM) {
                        $daily = JadwalHarian::create([
                            "TANGGAL_HARIAN" =>
                                $i->format("Y-m-d") .
                                " " .
                                $item->WAKTU_JADWAL_UMUM,
                            "ID_INSTRUKTUR" => $item->ID_INSTRUKTUR,
                            "ID_JADWAL_UMUM" => $item->ID_JADWAL_UMUM,
                            "STATUS_JADWAL_HARIAN" => "-",
                            "TGL_EXPIRED" => $expired,
                        ]);
                    }
                }
            }

            return redirect()
                ->intended("dashboard/jadwalHarian")
                ->with(["success" => "Berhasil mengenerate jadwal harian"]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $jadwalHarian = JadwalHarian::where("TANGGAL_HARIAN", $id)->first();
        $instruktur = Instruktur::all();

        return view("jadwal_harian/edit")->with([
            "user" => Auth::guard("pegawai")->user(),
            "jadwalHarian" => $jadwalHarian,
            "instruktur" => $instruktur,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $jadwalHarian = JadwalHarian::where("TANGGAL_HARIAN", $id)->first();

        if ($request->STATUS_JADWAL_HARIAN) {
            $jadwalHarian->STATUS_JADWAL_HARIAN =
                $request->STATUS_JADWAL_HARIAN;
        }

        if ($request->ID_INSTRUKTUR) {
            $jadwalHarian->ID_INSTRUKTUR = $request->ID_INSTRUKTUR;
        }

        $updateJadwalHarian = $jadwalHarian->update();

        if ($updateJadwalHarian) {
            return redirect()
                ->intended("dashboard/jadwalHarian")
                ->with(["success" => "Berhasil mengupdate jadwal Harian"]);
        }
        return redirect()
            ->intended("dashboard/editJadwalHarian/" . $id)
            ->with(["error" => "Tidak berhasil mengupdate jadwal umum"]);
    }

    public function search(Request $request)
    {
        $tanggalHarian = JadwalHarian::first();
        if ($request->keyword != null) {
            $instruktur = Instruktur::where(
                "NAMA_INSTRUKTUR",
                $request->keyword
            )->first();
            $kelas = Kelas::where("NAMA_KELAS", $request->keyword)->first();
            if ($instruktur) {
                $jadwalHarian = JadwalHarian::where(
                    "ID_INSTRUKTUR",
                    $instruktur->ID_INSTRUKTUR
                )->get();
            } elseif ($kelas) {
                $jadwalUmum = JadwalUmum::where(
                    "ID_KELAS",
                    $kelas->ID_KELAS
                )->first();
                $jadwalHarian = JadwalHarian::where(
                    "ID_JADWAL_UMUM",
                    $jadwalUmum->ID_JADWAL_UMUM
                )->get();
            } else {
                $jadwalHarian = JadwalHarian::where(
                    "TANGGAL_HARIAN",
                    $request->keyword
                )
                    ->orWhere("STATUS_JADWAL_HARIAN", $request->keyword)
                    ->get();
            }
        } else {
            $jadwalHarian = JadwalHarian::orderby(
                "TANGGAL_HARIAN",
                "asc"
            )->get();
        }

        return view("jadwal_harian/index")->with([
            "user" => Auth::guard("pegawai")->user(),
            "jadwalHarians" => $jadwalHarian,
            "tanggalHarian" => $tanggalHarian,
        ]);
    }
}
