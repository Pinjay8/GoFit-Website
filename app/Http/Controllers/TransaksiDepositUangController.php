<?php

namespace App\Http\Controllers;

use App\Models\TransaksiDepositUang;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Promo;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransaksiDepositUangController extends Controller
{
    //
    public function index()
    {
        $transaksiUang = TransaksiDepositUang::orderBy(
            "ID_TRANSAKSI_UANG",
            "asc"
        )->get();

        $member = Member::where("MASA_AKTIVASI", "<", Carbon::now())
            ->orWhere("MASA_AKTIVASI", null)
            ->get();

        $promo = Promo::all();

        return view("transaksiUang/index")->with([
            "user" => Auth::guard("pegawai")->user(),
            "transaksiUang" => $transaksiUang,
            "member" => $member,
            "promo" => $promo,
        ]);
    }

    public function create()
    {
        $member = Member::all();
        $promo = Promo::all();
        return view("transaksiUang/create")->with([
            "user" => Auth::guard("pegawai")->user(),
            "member" => $member,
            "promo" => $promo,
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate(
            [
                "ID_MEMBER" => ["required"],
                "JUMLAH_DEPOSIT_UANG" => ["required", "numeric"],
                "JUMLAH_UANG" => ["required"],
            ],
            [
                "ID_MEMBER.required" => "ID Member Tidak Boleh kosong",
                "JUMLAH_DEPOSIT_UANG.required" =>
                    "The nominal field is required",
                "JUMLAH_DEPOSIT_UANG.numeric" => "Inputan Hanya Boleh Angka",
                "JUMLAH_UANG.required" => "Jumlah Uang Tidak Boleh Kosong",
            ]
        );

        $member = Member::where("ID_MEMBER", $request->ID_MEMBER)->first();

        $member_check = Member::where("ID_MEMBER", $request->ID_MEMBER)
            ->where("MASA_AKTIVASI", "!=", null)
            ->where("MASA_AKTIVASi", ">=", Carbon::now())
            ->first();

        if (!$member_check) {
            return redirect()
                ->intended("dashboard/transaksiDepositUang")
                ->with([
                    "error" =>
                        "Member Tidak Aktif. Mohon Aktivasi Terlebih Dahulu",
                ]);
        }

        if (
            $request->JUMLAH_DEPOSIT_UANG >= 3000000 &&
            $member->SISA_DEPOSIT_UANG >= 500000
        ) {
            $promo = Promo::where("BONUS", 300000)->first();
            if ($promo) {
                $idPromo = $promo->ID_PROMO;
                $bonus = $promo->BONUS;
            } else {
                $idPromo = null;
                $bonus = 0;
            }
        } else {
            $idPromo = null;
            $bonus = 0;
        }

        if ($member->SISA_DEPOSIT_UANG) {
            $sisa = $member->SISA_DEPOSIT_UANG;
        } else {
            $sisa = 0;
        }

        if ($request->JUMLAH_UANG < $request->JUMLAH_DEPOSIT_UANG) {
            return redirect()
                ->back()
                ->with(["error" => "Uang Tidak Cukup"]);
        }

        $datadepomoney = TransaksiDepositUang::create([
            "ID_PROMO" => $idPromo,
            "ID_MEMBER" => $request->ID_MEMBER,
            "ID_PEGAWAI" => Auth::guard("pegawai")->user()->ID_PEGAWAI,
            "JUMLAH_DEPOSIT_UANG" => $request->JUMLAH_DEPOSIT_UANG,
            "BONUS_DEPOSIT_UANG" => $bonus,
            "SISA_DEPOSIT_UANG_TRANSAKSI" => $sisa,
            "TOTAL_DEPOSIT_UANG" =>
                $request->JUMLAH_DEPOSIT_UANG + $sisa + $bonus,
            "TANGGAL_TRANSAKSI_UANG" => Carbon::now(),
            "KEMBALIAN" =>
                $request->JUMLAH_UANG - $request->JUMLAH_DEPOSIT_UANG,
        ]);

        if ($datadepomoney) {
            $member = Member::where("ID_MEMBER", $request->ID_MEMBER)->first();
            $member->SISA_DEPOSIT_UANG =
                $request->JUMLAH_DEPOSIT_UANG + $sisa + $bonus;
            $member->update();
            $data = TransaksiDepositUang::latest("ID_TRANSAKSI_UANG")->first();
            return redirect()->intended("dashboard/transaksiDepositUang");
        } else {
            return redirect()
                ->intended("dashboard/transaksiDepositUang")
                ->with(["error" => "Tidak Berhasil Deposit Member"]);
        }
    }

    public function indexDepoUang(Request $request)
    {
        $this->validate(
            $request,
            [
                "ID_MEMBER" => "required",
                "JUMLAH_DEPOSIT_UANG" => ["required", "numeric"],
            ],
            [
                "ID_MEMBER.required" => "ID Member tidak boleh kosong",
                "JUMLAH_DEPOSIT_UANG.required" =>
                    "The nominal field is required",
                "JUMLAH_DEPOSIT_UANG.numeric" => "Format nominal is numeric",
            ]
        );

        $member = Member::where("ID_MEMBER", $request->ID_MEMBER)->first();

        return view("transaksiUang/inputUang")->with([
            "user" => Auth::guard("pegawai")->user(),
            "member" => $member,
            "jumlah_deposit" => $request->JUMLAH_DEPOSIT_UANG,
        ]);
    }

    // public function store(Request $request)
    // {
    //     $validate = $request->validate([
    //         "ID_MEMBER" => ["required"],
    //         "JUMLAH_DEPOSIT_UANG" => ["required", "numeric"],
    //     ]);

    //     $member = Member::where("ID_MEMBER", $request->ID_MEMBER)->first();

    //     $member_check = Member::where("ID_MEMBER", $request->ID_MEMBER)
    //         ->where("MASA_AKTIVASI", "!=", null)
    //         ->where("MASA_AKTIVASi", ">=", Carbon::now())
    //         ->first();

    //     if (!$member_check) {
    //         return redirect()
    //             ->intended("dashboard/transaksiDepositUang")
    //             ->with(["error" => "Member not activated"]);
    //     }

    //     if (
    //         $request->JUMLAH_DEPOSIT_UANG >= 3000000 &&
    //         $member->SISA_DEPOSIT_UANG >= 500000
    //     ) {
    //         $promo = Promo::where("BONUS", 300000)->first();

    //         if ($promo) {
    //             $idPromo = $promo->ID_PROMO;
    //             $bonus = $promo->BONUS;
    //         } else {
    //             $idPromo = null;
    //             $bonus = 0;
    //         }
    //     } else {
    //         $idPromo = null;
    //         $bonus = 0;
    //     }

    //     if ($member->SISA_DEPOSIT_UANG) {
    //         $sisa = $member->SISA_DEPOSIT_UANG;
    //     } else {
    //         $sisa = 0;
    //     }

    //     $dataTransaksiUang = TransaksiDepositUang::create([
    //         "ID_PROMO" => $idPromo,
    //         "ID_MEMBER" => $request->ID_MEMBER,
    //         "JUMLAH_DEPOSIT_UANG" => $request->JUMLAH_DEPOSIT_UANG,
    //         "TANGGAL_TRANSAKSI_UANG" => Carbon::now(),
    //         "TOTAL_DEPOSIT_UANG" =>
    //             $request->JUMLAH_DEPOSIT_UANG + $sisa + $bonus,
    //         "ID_PEGAWAI" => Auth::guard("pegawai")->user()->ID_PEGAWAI,
    //         "BONUS_DEPOSIT_UANG" => $bonus,
    //         "SISA_DEPOSIT_UANG_TRANSAKSI" => $sisa,
    //     ]);

    //     if ($dataTransaksiUang) {
    //         $member = Member::where("ID_MEMBER", $request->ID_MEMBER)->first();
    //         $member->SISA_DEPOSIT_UANG =
    //             $request->JUMLAH_DEPOSIT_UANG + $sisa + $bonus;
    //         $member->update();
    //         return redirect()->intended("dashboard/transaksiDepositUang");
    //     } else {
    //         return redirect()
    //             ->intended("dashboard/transaksiDepositUang")
    //             ->with(["error" => "Failed deposit member"]);
    //     }
    // }

    //  public function store(Request $request)
    // {
    //     $this->validate(
    //         $request,
    //         [
    //             "ID_MEMBER" => "required",
    //             "JUMLAH_DEPOSIT_UANG" => "required",
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

    public function cetakStrukDepositReguler($id)
    {
        $transaksiUang = TransaksiDepositUang::where(
            "ID_TRANSAKSI_UANG",
            $id
        )->first();
        return view("transaksiUang/cetakStrukUang")->with([
            "transaksiUang" => $transaksiUang,
        ]);
    }
}
