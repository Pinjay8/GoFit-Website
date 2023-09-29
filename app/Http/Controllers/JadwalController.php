<?php

namespace App\Http\Controllers;

use App\Models\JadwalUmum;
use App\Models\Kelas;
use App\Models\Instruktur;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwalUmum = JadwalUmum::all();
        return view("jadwal/index")->with([
            "user" => Auth::guard("pegawai")->user(),
            "jadwals" => $jadwalUmum,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $kelas = Kelas::all();
        $instruktur = Instruktur::all();
        return view("jadwal/create")->with([
            "user" => Auth::guard("pegawai")->user(),
            "kelas" => $kelas,
            "instruktur" => $instruktur,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate(
            [
                "ID_KELAS" => ["required", "numeric"],
                "ID_INSTRUKTUR" => ["required", "numeric"],
                "HARI_JADWAL_UMUM" => ["required"],
                "WAKTU_JADWAL_UMUM" => ["required", "date_format:H:i:s"],
                // 'TANGGAL_JADWAL' => ['required','date_format:Y-m-d']
            ],
            [
                "ID_KELAS.required" => "Kelas belum ada inputan",
                "ID_INSTRUKTUR.required" => "Instruktur belum ada inputan",
                "HARI_JADWAL_UMUM" => "Hari jadwal umum belum ada inputan",
                "WAKTU_JADWAL_UMUM" => "Waktu jadwal umum belum ada inputan",
            ]
        );

        $dataJadwalUmum = $request->all();

        //cek apakah jadwal instruktur bertabrakan
        $cekJadwalUmum = JadwalUmum::where(
            "ID_INSTRUKTUR",
            $request->ID_INSTRUKTUR
        )
            ->where("HARI_JADWAL_UMUM", $request->HARI_JADWAL_UMUM)
            ->where("WAKTU_JADWAL_UMUM", $request->WAKTU_JADWAL_UMUM)
            ->first();

        if ($cekJadwalUmum) {
            return redirect()
                ->intended("dashboard/createJadwalUmum")
                ->with(["error" => "Instruktur sudah terjadwal dijadwal umum"]);
        } else {
            $jadwalUmum = JadwalUmum::create($dataJadwalUmum);

            if ($jadwalUmum) {
                return redirect()
                    ->intended("dashboard/jadwal")
                    ->with([
                        "success" => "Berhasil memasukkan data jadwal umum",
                    ]);
            }
            return redirect()
                ->intended("dashboard/createJadwalUmum")
                ->with([
                    "error" => "Tidak berhasil memasukkan data jadwal umum",
                ]);
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
        $jadwalUmum = JadwalUmum::where("ID_JADWAL_UMUM", $id)->first();
        $kelas = Kelas::all();
        $instruktur = Instruktur::all();

        return view("jadwal/edit")->with([
            "user" => Auth::guard("pegawai")->user(),
            "jadwalUmum" => $jadwalUmum,
            "kelas" => $kelas,
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
        $jadwalUmum = JadwalUmum::find($id);
        $setJadwalUmum = JadwalUmum::find($id);

        if (
            $request->ID_KELAS != $setJadwalUmum->ID_KELAS &&
            $request->ID_INSTRUKTUR == $setJadwalUmum->ID_INSTRUKTUR &&
            $request->HARI_JADWAL_UMUM == $setJadwalUmum->HARI_JADWAL_UMUM &&
            $request->WAKTU_JADWAL_UMUM == $setJadwalUmum->WAKTU_JADWAL_UMUM
        ) {
            $jadwalUmum->ID_KELAS = $request->ID_KELAS;
            $jadwalUmum->update();
            if ($jadwalUmum) {
                return redirect()
                    ->intended("dashboard/jadwal")
                    ->with(["success" => "Berhasil mengupdate jadwal umum"]);
            }
            return redirect()
                ->intended("dashboard/editJadwalUmum/" . $id)
                ->with([
                    "error" => "Tidak berhasil mengupdate data jadwal umum",
                ]);
        }

        if ($request->ID_INSTRUKTUR) {
            $jadwalUmum->ID_INSTRUKTUR = $request->ID_INSTRUKTUR;
        }
        if ($request->HARI_JADWAL_UMUM) {
            $jadwalUmum->HARI_JADWAL_UMUM = $request->HARI_JADWAL_UMUM;
        }
        if ($request->WAKTU_JADWAL_UMUM) {
            $jadwalUmum->WAKTU_JADWAL_UMUM = $request->WAKTU_JADWAL_UMUM;
        }

        // if($jadwalUmum->update() == null) {
        //     return redirect()->intended('dashboard/general-jadwalUmum')->with(['success' => 'Successfully upda jadwalUmum']);
        // }

        $cekJadwalUmum = JadwalUmum::where(
            "ID_INSTRUKTUR",
            $request->ID_INSTRUKTUR
        )
            ->where("HARI_JADWAL_UMUM", $request->HARI_JADWAL_UMUM)
            ->where("WAKTU_JADWAL_UMUM", $request->WAKTU_JADWAL_UMUM)
            ->first();

        if ($cekJadwalUmum) {
            return redirect()
                ->intended("dashboard/editJadwalUmum/" . $id)
                ->with(["error" => "Instruktur sudah terjadwal dijadwal umum"]);
        } else {
            $jadwalUmum->ID_KELAS = $request->ID_KELAS;
            $updateJadwalUmum = $jadwalUmum->update();

            if ($updateJadwalUmum) {
                return redirect()
                    ->intended("dashboard/jadwal")
                    ->with(["success" => "Berhasil mengupdate jadwal umum"]);
            }
            return redirect()
                ->intended("dashboard/editJadwalUmum/" . $id)
                ->with(["error" => "Tidak berhasil mengupdate jadwal umum"]);
        }
    }

    public function destroy($id)
    {
        //
        $jadwalUmum = JadwalUmum::find($id);

        try {
            if ($jadwalUmum) {
                $jadwalUmum->delete();
                return redirect()
                    ->intended("dashboard/jadwal")
                    ->with([
                        "success" => "Berhasil menghapus jadwal umum",
                    ]);
            } else {
                return redirect()
                    ->intended("dashboard/jadwal")
                    ->with([
                        "error" => "Tidak berhasil menghapus jadwal umum",
                    ]);
            }
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with("error", $e->getMessage());
        }
    }
}
