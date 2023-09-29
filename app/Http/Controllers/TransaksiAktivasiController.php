<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiAktivasi;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransaksiAktivasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksiAktivasi = TransaksiAktivasi::orderBy(
            "ID_TRANSAKSI_AKTIVASI",
            "desc"
        )->paginate(10);
        $member = Member::where("MASA_AKTIVASI", "<", Carbon::now())
            ->orWhere("MASA_AKTIVASI", null)
            ->get();

        return view("transaksi_aktivasi/index")->with([
            "user" => Auth::guard("pegawai")->user(),
            "transaksiAktivasi" => $transaksiAktivasi,
            "member" => $member,
        ]);
    }

    public function cetakStrukAktivasi($id)
    {
        $transaksiAktivasi = TransaksiAktivasi::where(
            "ID_TRANSAKSI_AKTIVASI",
            $id
        )->first();
        return view("transaksi_aktivasi/cetakStruk")->with([
            "transaksiAktivasi" => $transaksiAktivasi,
        ]);
    }

    public function create()
    {
        $member = Member::where("MASA_AKTIVASI", "<", Carbon::now())
            ->orWhere("MASA_AKTIVASI", null)
            ->get();

        return view("transaksi_aktivasi/create")->with([
            "user" => Auth::guard("pegawai")->user(),
            "members" => $member,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                "ID_MEMBER" => "required",
                "JUMLAH_UANG" => "required",
            ],
            [
                "ID_MEMBER.required" => "ID Member Tidak Boleh Kosong",
                "JUMLAH_UANG.required" =>
                    "Jumlah Uang Yang Diinputkan tidak boleh kosong",
            ]
        );

        $member = Member::where("ID_MEMBER", $request->ID_MEMBER)->first();
        $pegawai = Auth::guard("pegawai")->user();

        if ($request->JUMLAH_UANG < 3000000) {
            return redirect()
                ->back()
                ->with(["error" => "Your money is less"]);
        }

        if ($member) {
            $activation_transaction = TransaksiAktivasi::create([
                "ID_MEMBER" => $member->ID_MEMBER,
                "ID_PEGAWAI" => $pegawai->ID_PEGAWAI,
                "TANGGAL_AKTIVASI" => Carbon::now()->format("Y-m-d H:i:s"),
                "TANGGAL_EXPIRED_TRANSAKSI_AKTIVASI" => Carbon::now()
                    ->addYears(1)
                    ->format("Y-m-d H:i:s"),
                "BIAYA_AKTIVASI" => 3000000,
                "STATUS" => "Sudah Dibayar",
                "KEMBALIAN" => $request->JUMLAH_UANG - 3000000,
            ]);

            if ($activation_transaction) {
                // generate masa aktif member di table member
                $member->MASA_AKTIVASI = Carbon::now()
                    ->addYears(1)
                    ->format("Y-m-d H:i:s");
                $member->update();
                $data = TransaksiAktivasi::latest(
                    "ID_TRANSAKSI_AKTIVASI"
                )->first();
                return redirect()->intended("dashboard/transaksiAktivasi");
            } else {
                return redirect()
                    ->intended("dashboard/transaksiAktivasi")
                    ->with(["error" => "Tidak Berhasil Aktivasi Member"]);
            }
        } else {
            return redirect()
                ->intended("dashboard/transaksiAktivasi")
                ->with(["error" => "Tidak Berhasil Aktivasi Member"]);
        }
    }

    public function indexAktivasi(Request $request)
    {
        $this->validate(
            $request,
            [
                "ID_MEMBER" => "required",
            ],
            [
                "ID_MEMBER.required" => "ID Member tidak boleh kosong",
            ]
        );

        $member = Member::where("ID_MEMBER", $request->ID_MEMBER)->first();

        return view("transaksi_aktivasi/inputAktivasi")->with([
            "user" => Auth::guard("pegawai")->user(),
            "member" => $member,
        ]);
    }

    // public function store(Request $request)
    // {
    //     $this->validate(
    //         $request,
    //         [
    //             "ID_MEMBER" => "required",
    //         ],
    //         [
    //             "ID_MEMBER.required" => "The member field is required",
    //         ]
    //     );

    //     $member = Member::where("ID_MEMBER", $request->ID_MEMBER)->first();
    //     $pegawai = Auth::guard("pegawai")->user();

    //     if ($member) {
    //         $transaksiAktivasi = TransaksiAktivasi::create([
    //             "ID_MEMBER" => $member->ID_MEMBER,
    //             "ID_PEGAWAI" => $pegawai->ID_PEGAWAI,
    //             "TANGGAL_AKTIVASI" => Carbon::now()->format("Y-m-d H:i:s"),
    //             "TANGGAL_EXPIRED_TRANSAKSI_AKTIVASI" => Carbon::now()
    //                 ->addYears(1)
    //                 ->format("Y-m-d H:i:s"),
    //             "BIAYA_AKTIVASI" => 3000000,
    //             "STATUS" => "Sudah Dibayar",
    //         ]);

    //         if ($transaksiAktivasi) {
    //             // generate masa aktif member di table member
    //             $member->MASA_AKTIVASI = Carbon::now()
    //                 ->addYears(1)
    //                 ->format("Y-m-d H:i:s");
    //             $member->update();
    //             $data = TransaksiAktivasi::latest(
    //                 "ID_TRANSAKSI_AKTIVASI"
    //             )->first();
    //             return redirect()->intended("dashboard/transaksiAktivasi");
    //         } else {
    //             return redirect()
    //                 ->intended("dashboard/transaksiAktivasi")
    //                 ->with(["error" => "Failed activate member"]);
    //         }
    //     } else {
    //         return redirect()
    //             ->intended("dashboard/transaksiAktivasi")
    //             ->with(["error" => "Failed activate member"]);
    //     }
    // }
}
