<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instruktur;
use App\Models\PresensiInstruktur;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InstrukturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Tampilan Awal Instruktur
        $instruktur = Instruktur::paginate(5);
        return view("instruktur/index")->with([
            "user" => Auth::guard("pegawai")->user(),
            "instrukturs" => $instruktur,
        ]);
    }

    public function indexIzin()
    {
        //Tampilan Awal Instruktur
        $instruktur = Instruktur::all();
        return view("instruktur/resetIzin")->with([
            "user" => Auth::guard("pegawai")->user(),
            "instrukturs" => $instruktur,
        ]);
    }

    public function getDataInstruktur(Request $request, $id)
    {
        if ($request->expectsjson()) {
            // $dataInstruktur = DB::table("instruktur as i")
            //     ->select(
            //         "i.NAMA_INSTRUKTUR",
            //         "i.EMAIL_INSTRUKTUR",
            //         "i.JENIS_KELAMIN_INSTRUKTUR",
            //         "i.NO_TELPON_INSTRUKTUR",
            //         "pi.WAKTU_TERLAMBAT"
            //     )
            //     ->leftJoin(
            //         "presensi_instruktur as pi",
            //         "i.ID_INSTRUKTUR",
            //         "pi.ID_INSTRUKTUR"
            //     )
            //     ->where("i.ID_INSTRUKTUR", $id)
            //     ->orWhere("pi.ID_INSTRUKTUR", $id)
            //     ->first();

            $dataInstruktur = Instruktur::where("ID_INSTRUKTUR", $id)->first();

            if ($dataInstruktur) {
                return response(
                    [
                        "message" => "Berhasil mengambil data instruktur",
                        "data" => $dataInstruktur,
                    ],
                    200
                );
            }

            return response(
                [
                    "message" => "Instruktur tidak ditemukan",
                    "data" => null,
                ],
                200
            );
        }
    }

    public function getAktivitasInstruktur(Request $request, $id)
    {
        if ($request->expectsjson()) {
            $dataInstruktur = DB::table("instruktur as i")
                ->select(
                    "k.NAMA_KELAS",
                    "k.TARIF_KELAS",
                    "ju.TANGGAL_JADWAL_UMUM",
                    "ju.WAKTU_JADWAL_UMUM",
                    "ju.HARI_JADWAL_UMUM",
                    "i.NAMA_INSTRUKTUR",
                    "pi.JAM_MULAI",
                    "pi.JAM_SELESAI"
                )
                ->leftJoin(
                    "jadwal_umum as ju",
                    "i.ID_INSTRUKTUR",
                    "=",
                    "ju.ID_INSTRUKTUR"
                )
                ->leftJoin("kelas as k", "ju.ID_KELAS", "=", "k.ID_KELAS")
                ->leftJoin(
                    "presensi_instruktur as pi",
                    "ju.ID_KELAS",
                    "=",
                    "pi.ID_INSTRUKTUR"
                )
                ->where("i.ID_INSTRUKTUR", $id)
                ->get();

            if ($dataInstruktur) {
                return response(
                    [
                        "message" => "Berhasil mengambil data instruktur",
                        "data" => $dataInstruktur,
                    ],
                    200
                );
            }

            return response(
                [
                    "message" => "Instruktur tidak ditemukan",
                    "data" => null,
                ],
                200
            );
        }
    }

    public function resetIzinProcess()
    {
        $instruktur = Instruktur::all();

        if ($instruktur) {
            if (
                $instruktur->first()->TGL_EXPIRED < Carbon::now() ||
                $instruktur->first()->TGL_EXPIRED == null
            ) {
                foreach ($instruktur as $item) {
                    $item->JUMLAH_TERLAMBAT = 0;
                    $item->TGL_EXPIRED = Carbon::now()->addMonths(1);
                    $item->update();
                }
                return redirect()
                    ->intended("dashboard/resetIzin")
                    ->with([
                        "success" =>
                            "Succesfully reset instruktur late. You can reset again on " .
                            $item->TGL_EXPIRED,
                    ]);
            } else {
                return redirect()
                    ->intended("dashboard/resetIzin")
                    ->with([
                        "error" =>
                            "Failed reset instruktur late. You can reset again on " .
                            $instruktur->first()->TGL_EXPIRED,
                    ]);
            }
        }
        return redirect()
            ->intended("dashboard/resetIzin")
            ->with(["error" => "Failed reset instructor late"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Tampilan Create Instruktur
        return view("instruktur/create")->with([
            "user" => Auth::guard("pegawai")->user(),
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
        $validate = $request->validate([
            "NAMA_INSTRUKTUR" => ["required"],
            "NO_TELPON_INSTRUKTUR" => ["required"],
            "USIA_INSTRUKTUR" => ["required"],
            "JENIS_KELAMIN_INSTRUKTUR" => ["required"],
            "EMAIL_INSTRUKTUR" => ["required"],
        ]);

        $instruktur = Instruktur::create($request->all());

        if ($instruktur) {
            return redirect()
                ->intended("dashboard/instruktur")
                ->with("success", "Berhasil menambahkan instruktur");
        }
        return redirect()
            ->intended("dashboard/main")
            ->with("error", "Tidak berhasil menambahkan instruktur");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        //
        if ($request->keyword == null) {
            $instruktur = Instruktur::orderby("ID_INSTRUKTUR", "ASC")->paginate(
                5
            );
        } else {
            $instruktur = Instruktur::where(
                "NAMA_INSTRUKTUR",
                $request->keyword
            )
                ->orWhere("ID_INSTRUKTUR", $request->keyword)
                ->orWhere("USIA_INSTRUKTUR", $request->keyword)
                ->orWhere("JENIS_KELAMIN_INSTRUKTUR", $request->keyword)
                ->orWhere("NO_TELPON_INSTRUKTUR", $request->keyword)
                ->orWhere("JUMLAH_TERLAMBAT", $request->keyword)
                ->paginate(5);
        }
        return view("instruktur/index")->with([
            "user" => Auth::guard("pegawai")->user(),
            "instrukturs" => $instruktur,
        ]);
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
        $instruktur = Instruktur::where("ID_INSTRUKTUR", $id)->first();

        return view("instruktur/edit")->with([
            "user" => Auth::guard("pegawai")->user(),
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
        $instruktur = Instruktur::where("ID_INSTRUKTUR", $id)->first();

        if ($request->NAMA_INSTRUKTUR) {
            $instruktur->NAMA_INSTRUKTUR = $request->NAMA_INSTRUKTUR;
        }

        if ($request->JENIS_KELAMIN_INSTRUKTUR) {
            $instruktur->JENIS_KELAMIN_INSTRUKTUR =
                $request->JENIS_KELAMIN_INSTRUKTUR;
        }

        if ($request->NO_TELPON_INSTRUKTUR) {
            $instruktur->NO_TELPON_INSTRUKTUR = $request->NO_TELPON_INSTRUKTUR;
        }

        if ($request->USIA_INSTRUKTUR) {
            $instruktur->USIA_INSTRUKTUR = $request->USIA_INSTRUKTUR;
        }

        if ($request->TANGGAL_LAHIR_INSTRUKTUR) {
            $instruktur->TANGGAL_LAHIR_INSTRUKTUR =
                $request->TANGGAL_LAHIR_INSTRUKTUR;
        }

        if ($request->EMAIL_INSTRUKTUR) {
            $instruktur->EMAIL_INSTRUKTUR = $request->EMAIL_INSTRUKTUR;
        }

        if ($request->password) {
            $instruktur->password = \bcrypt($request->password);
        }

        $instruktur->update();

        if ($instruktur) {
            return redirect()
                ->intended("dashboard/instruktur")
                ->with(["success" => "Berhasil mengubah data"]);
        }
        return redirect()
            ->intended("dashboard/editInstruktur")
            ->with(["error" => "Tidak berhasil mengubah data"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $instruktur = Instruktur::where("ID_INSTRUKTUR", $id);

        $instruktur->delete();

        if ($instruktur) {
            return redirect()
                ->intended("dashboard/instruktur")
                ->with("success", "Instruktur berhasil dihapus");
        } else {
            return redirect()
                ->intended("dashboard/instruktur")
                ->with("error", "Instruktur tidak berhasil dihapus");
        }
    }
}
