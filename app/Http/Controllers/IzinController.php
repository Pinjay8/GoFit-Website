<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Izin;
use App\Models\JadwalHarian;
use App\Models\Instruktur;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class IzinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->accepts("text/html")) {
            // $izin = Izin::where(
            //     "STATUS_KONFIRMASI",
            //     "Belum Dikonfirmasi"
            // )->get();
            $izin = Izin::all();
            return view("izin/index")->with([
                "user" => Auth::guard("pegawai")->user(),
                // "instrukturs" => $instruktur,
                "izin" => $izin,
            ]);
        }

        // else {
        //     // $izinInstruktur = Izin::all();
        //     $izinInstruktur = Izin::all();

        //     if (count($izinInstruktur) > 0) {
        //         return response(
        //             [
        //                 "message" => "Retrieve All Success",
        //                 "data" => $izinInstruktur,
        //             ],
        //             200
        //         );
        //     }

        //     return response(
        //         [
        //             "message" => "Data is Empty",
        //             "data" => null,
        //         ],
        //         400
        //     );
        // }
    }

    public function getDataIzin(Request $request, $id)
    {
        if ($request->expectsjson()) {
            $izinInstruktur = Izin::where("ID_INSTRUKTUR", $id)->get();

            if ($izinInstruktur) {
                return response(
                    [
                        "message" => "Berhasil mengambil data izin instruktur",
                        "data" => $izinInstruktur,
                    ],
                    200
                );
            }
            return response(
                [
                    "message" => "Tidak berhasil mengambil data zin instruktur",
                    "data" => null,
                ],
                200
            );
        }
    }

    public function getDataSchedule(Request $request, $id)
    {
        if ($request->expectsjson()) {
            $schedule = JadwalHarian::where("ID_INSTRUKTUR", $id)
                ->where("TANGGAL_HARIAN", ">", Carbon::now())
                ->get();
            if ($schedule) {
                return response(
                    [
                        "message" => "Successfully get data permission",
                        "data" => $schedule,
                    ],
                    200
                );
            }
            return response(
                [
                    "message" => "Failed get data permission",
                    "data" => null,
                ],
                200
            );
        }
    }

    public function getDataJadwal($id)
    {
        $permission = Izin::orderby("ID_IZIN", "asc")
            ->where("ID_IZIN", $id)
            ->first();

        if ($permission) {
            $permission->TANGGAL_KONFIRMASI = Carbon::now();
            $permission->STATUS_KONFIRMASI = "Konfirmasi";
            $schedule = JadwalHarian::where(
                "TANGGAL_HARIAN",
                $permission->TANGGAL_IZIN
            )->first();
            if ($schedule) {
                if ($permission->INSTRUKTUR_PENGGANTI) {
                    $instructor = Instruktur::where(
                        "NAMA_INSTRUKTUR",
                        $permission->INSTRUKTUR_PENGGANTI
                    )->first();
                    $instructor2 = Instruktur::where(
                        "ID_INSTRUKTUR",
                        $schedule->ID_INSTRUKTUR
                    )->first();
                    if ($instructor) {
                        $schedule->ID_INSTRUKTUR = $instructor->ID_INSTRUKTUR;
                        $schedule->STATUS_JADWAL_HARIAN =
                            "menggantikan " . $instructor2->NAMA_INSTRUKTUR;
                    }
                } else {
                    $schedule->STATUS_JADWAL_HARIAN = "Libur";
                }
                $schedule->update();
            }
            $permission->update();
            return redirect()
                ->intended("dashboard/izinInstruktur")
                ->with(["success" => "Sucessfully Confirmation"]);
        }
        return redirect()
            ->intended("dashboard/izinInstruktur")
            ->with(["error" => "Failed Confirmation"]);
    }

    public function store(Request $request)
    {
        if ($request->expectsJson()) {
            $validate = Validator::make($request->all(), [
                "ID_INSTRUKTUR" => ["required"],
                "TANGGAL_IZIN" => ["required"],
                "KETERANGAN_IZIN" => ["required"],
            ]);

            if ($validate->fails()) {
                return response(
                    ["success" => false, "message" => $validate->errors()],
                    400
                );
            }

            if ($request->INSTRUKTUR_PENGGANTI) {
                $instructor = Instruktur::where(
                    "NAMA_INSTRUKTUR",
                    $request->INSTRUKTUR_PENGGANTI
                )->first();
                if ($instructor) {
                    $temp_instructor = $instructor->NAMA_INSTRUKTUR;
                } else {
                    return response(
                        [
                            "message" => "Nama Instruktur Pengganti Tidak Ada",
                            "data" => null,
                        ],
                        400
                    );
                }
            } else {
                $temp_instructor = null;
            }

            $check = Izin::where(
                "TANGGAL_IZIN",
                $request->TANGGAL_IZIN
            )->exists();

            if ($check) {
                return response(
                    [
                        "message" =>
                            "You have been create permission on this date",
                        "data" => null,
                    ],
                    400
                );
            }

            $store_data = Izin::create([
                "ID_INSTRUKTUR" => $request->ID_INSTRUKTUR,
                "INSTRUKTUR_PENGGANTI" => $temp_instructor,
                "TANGGAL_IZIN" => $request->TANGGAL_IZIN,
                "KETERANGAN_IZIN" => $request->KETERANGAN_IZIN,
                "TANGGAL_PENGAJUAN" => Carbon::now(),
                "STATUS_KONFIRMASI" => null,
                "TANGGAL_KONFIRMASI" => null,
            ]);

            if ($store_data) {
                return response(
                    [
                        "message" => "Successfully added permission",
                        "data" => $store_data,
                    ],
                    200
                );
            }
            return response(
                [
                    "message" => "Failed added permission",
                    "data" => null,
                ],
                400
            );
        }
    }

    public function show($id)
    {
        $izinInstruktur = Izin::find($id);
        if (!is_null($izinInstruktur)) {
            return response(
                [
                    "message" => "Retrieve User Profile Success",
                    "data" => $izinInstruktur,
                ],
                200
            );
        }

        return response(
            [
                "message" => "User Profile Not Found",
                "data" => null,
            ],
            404
        );
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
        $izin = Izin::where("ID_IZIN", $id)->first();
        $instruktur = Instruktur::all();

        return view("izin/edit")->with([
            "user" => Auth::guard("pegawai")->user(),
            "izin" => $izin,
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
        // $instruktur = Instruktur::where(
        //     "ID_INSTRUKTUR",
        //     $request->ID_INSTRUKTUR
        // )->first();

        // $izin = Izin::where("ID_IZIN", $id)->first();

        // if ($request->STATUS_KONFIRMASI && $izin->TANGGAL_KONFIRMASI) {
        //     $izin->STATUS_KONFIRMASI = $request->STATUS_KONFIRMASI;
        //     $izin->TANGGAL_KONFIRMASI = Carbon::now()->format("Y-m-d");
        // } elseif (
        //     $request->STATUS_KONFIRMASI === null &&
        //     $izin->TANGGAL_KONFIRMASI
        // ) {
        //     $izin->STATUS_KONFIRMASI = $request->STATUS_KONFIRMASI;
        //     $izin->TANGGAL_KONFIRMASI = Carbon::now()->format("Y-m-d");
        // }

        $izinInstruktur = Izin::orderby("ID_IZIN", "desc")
            ->where("ID_IZIN", $id)
            ->first();

        if ($izinInstruktur) {
            $izinInstruktur->TANGGAL_KONFIRMASI = Carbon::now();
            $izinInstruktur->STATUS_KONFIRMASI = "Konfirmasi";

            $jadwalHarian = JadwalHarian::where(
                "TANGGAL_HARIAN",
                $izinInstruktur->TANGGAL_IZIN
            )->first();

            if ($jadwalHarian) {
                if ($izinInstruktur->INSTRUKTUR_PENGGANTI) {
                    $instruktur = Instruktur::where(
                        "NAMA_INSTRUKTUR",
                        $izinInstruktur->INSTRUKTUR_PENGGANTI
                    )->first();
                    $instruktur2 = Instruktur::where(
                        "ID_INSTRUKTUR",
                        $jadwalHarian->ID_INSTRUKTUR
                    )->first();

                    if ($instruktur) {
                        $jadwalHarian->ID_INSTRUKTUR =
                            $instruktur->ID_INSTRUKTUR;
                        $jadwalHarian->STATUS_JADWAL_HARIAN =
                            "Menggantikan  " . $instruktur2->NAMA_INSTRUKTUR;
                    }
                } else {
                    $jadwalHarian->STATUS_JADWAL_HARIAN = "Libur";
                }

                $jadwalHarian->update();
            }

            $izinInstruktur->update();
            return redirect()
                ->intended("dashboard/izinInstruktur")
                ->with([
                    "success" => "Berhasil mengupdate izin instruktur",
                ]);
        }
        return redirect()
            ->intended("dashboard/izinInstruktur")
            ->with([
                "error" => "Tidak Berhasil mengupdate izin instruktur",
            ]);
    }
}
