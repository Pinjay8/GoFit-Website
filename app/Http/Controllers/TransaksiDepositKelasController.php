<?php

namespace App\Http\Controllers;

use App\Models\TransaksiDepositUang;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\MemberDepo;
use App\Models\Promo;
use App\Models\Kelas;
use App\Models\TransaksiDepositKelas;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransaksiDepositKelasController extends Controller
{
    //
    public function index(Request $request)
    {
        $transaksiKelas = TransaksiDepositKelas::orderBy(
            "ID_TRANSAKSI_KELAS",
            "asc"
        )->get();
        $member = Member::where("MASA_AKTIVASI", "<", Carbon::now())
            ->orWhere("MASA_AKTIVASI", null)
            ->get();
        $promo = Promo::all();
        $kelas = Kelas::all();
        // $memberdepo = MemberDepo::where("ID_MEMBER_DEPO", "ID_MEMBER")->first();
        $memberdepo = MemberDepo::all();

        return view("transaksiKelas/index")->with([
            "user" => Auth::guard("pegawai")->user(),
            "transaksiKelas" => $transaksiKelas,
            "member" => $member,
            // "SISA_DEPO" => $memberdepo->SISA_DEPO,
            "member_deposit" => $memberdepo,
            "promo" => $promo,
            "kelas" => $kelas,
        ]);
    }

    public function create()
    {
        $member = Member::all();
        $promo = Promo::all();
        $kelas = Kelas::all();

        return view("transaksiKelas/create")->with([
            "user" => Auth::guard("pegawai")->user(),
            "member" => $member,
            "promo" => $promo,
            "kelas" => $kelas,
        ]);
    }

    // public function store(Request $request)
    // {
    //     $validate = $request->validate([
    //         "ID_MEMBER" => ["required"],
    //         "ID_KELAS" => ["required"],
    //         "JUMLAH_DEPOSIT" => ["required", "numeric"],
    //         "JUMLAH_UANG" => ["required"],
    //     ]);

    //     $member = Member::where("ID_MEMBER", $request->ID_MEMBER)->first();

    //     $member_check = Member::where("ID_MEMBER", $request->ID_MEMBER)
    //         ->where("MASA_AKTIVASI", "!=", null)
    //         ->where("MASA_AKTIVASi", ">=", Carbon::now())
    //         ->first();

    //     if (!$member_check) {
    //         return redirect()
    //             ->intended("dashboard/transaksiDepositKelas")
    //             ->with(["error" => "Member belum aktivasi"]);
    //     }

    //     $dataDepositKelas = TransaksiDepositKelas::where(
    //         "ID_MEMBER",
    //         $request->ID_MEMBER
    //     )
    //         ->orderby("ID_TRANSAKSI_KELAS", "asc")
    //         ->first();

    //     if ($member) {
    //         if (
    //             ($member->MASA_BERLAKU_KELAS < Carbon::now() &&
    //                 $member->SISA_DEPOSIT_KELAS != 0) ||
    //             ($member->MASA_BERLAKU_KELAS > Carbon::now() &&
    //                 $member->SISA_DEPOSIT_KELAS == 0) ||
    //             ($member->MASA_BERLAKU_KELAS < Carbon::now() &&
    //                 $member->SISA_DEPOSIT_KELAS == 0)
    //         ) {
    //             $member->SISA_DEPOSIT_KELAS = 0;
    //             $member->update();
    //         } else {
    //             return redirect()
    //                 ->intended("dashboard/transaksiDepositKelas")
    //                 ->with([
    //                     "error" =>
    //                         "Member cant deposit before expired date or remaining deposit = 0",
    //                 ]);
    //         }
    //     }

    //     $member_deposit = MemberDepo::where("ID_MEMBER", $request->ID_MEMBER)
    //         ->where("ID_KELAS", $request->ID_KELAS)
    //         ->first();
    //     if ($member_deposit) {
    //         if (
    //             ($member_deposit->MASA_BERLAKU < Carbon::now() &&
    //                 $member_deposit->SISA_DEPO != 0) ||
    //             ($member_deposit->MASA_BERLAKU > Carbon::now() &&
    //                 $member_deposit->SISA_DEPO == 0) ||
    //             ($member_deposit->MASA_BERLAKU < Carbon::now() &&
    //                 $member_deposit->SISA_DEPO == 0)
    //         ) {
    //             $member_deposit->SISA_DEPO = 0;
    //             $member_deposit->MASA_BERLAKU = null;
    //             $member_deposit->update();
    //         } else {
    //             return redirect()
    //                 ->intended("dashboard/transaksiDepositKelas")
    //                 ->with([
    //                     "error" =>
    //                         "This member has been deposit this class. Member cant deposit before expired date or remaining deposit = 0",
    //                 ]);
    //         }
    //     }

    //     if ($request->JUMLAH_DEPOSIT == 5 || $request->JUMLAH_DEPOSIT == 10) {
    //         $promo = Promo::where(
    //             "MINIMAL_BELI",
    //             $request->JUMLAH_DEPOSIT
    //         )->first();
    //         if ($promo) {
    //             if ($promo->MINIMAL_BELI == 5) {
    //                 $month = 1;
    //             } else {
    //                 $month = 2;
    //             }
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

    //     $kelas = Kelas::where("ID_KELAS", $request->ID_KELAS)->first();

    //     $dataDepositKelas = TransaksiDepositKelas::create([
    //         "ID_MEMBER" => $request->ID_MEMBER,
    //         "ID_PROMO" => $idPromo,
    //         "ID_PEGAWAI" => Auth::guard("pegawai")->user()->ID_PEGAWAI,
    //         "ID_KELAS" => $request->ID_KELAS,
    //         "JUMLAH_DEPOSIT" => $request->JUMLAH_DEPOSIT,
    //         "TANGGAL_TRANSAKSI_KELAS" => Carbon::now(),
    //         "BONUS_DEPOSIT_KELAS" => $bonus,
    //         "TOTAL_DEPOSIT_KELAS" => $request->JUMLAH_DEPOSIT + $bonus,
    //         "JUMLAH_BAYAR" => $kelas->TARIF_KELAS * $request->JUMLAH_DEPOSIT,
    //         "MASA_BERLAKU_KELAS" => Carbon::now()->addMonths($month),
    //     ]);

    //     if ($dataDepositKelas) {
    //         $member_deposit2 = MemberDepo::where(
    //             "ID_MEMBER",
    //             $request->ID_MEMBER
    //         )
    //             ->where("ID_KELAS", $request->ID_KELAS)
    //             ->first();

    //         if ($member_deposit2) {
    //             $member_deposit2->SISA_DEPO = $request->JUMLAH_DEPOSIT + $bonus;
    //             $member_deposit2->MASA_BERLAKU = Carbon::now()->addMonths(
    //                 $month
    //             );
    //             $member_deposit2->update();
    //         } else {
    //             $member_deposit_create = MemberDepo::create([
    //                 "ID_MEMBER" => $request->ID_MEMBER,
    //                 "ID_KELAS" => $request->ID_KELAS,
    //                 "SISA_DEPO" => $request->JUMLAH_DEPOSIT + $bonus,
    //                 "MASA_BERLAKU" => Carbon::now()->addMonths($month),
    //             ]);
    //         }
    //         $data = TransaksiDepositKelas::latest(
    //             "ID_TRANSAKSI_KELAS"
    //         )->first();
    //         return redirect()->intended("dashboard/transaksiDepositKelas");
    //     } else {
    //         return redirect()
    //             ->intended("dashboard/transaksiDepositKelas")
    //             ->with(["error" => "Failed deposit member"]);
    //     }
    // }

    public function store(Request $request)
    {
        $validate = $request->validate(
            [
                "ID_MEMBER" => ["required"],
                "ID_KELAS" => ["required"],
                "JUMLAH_DEPOSIT" => ["required", "numeric"],
                "JUMLAH_UANG" => ["required"],
            ],
            [
                "ID_MEMBER.required" => "The member name field is required",
                "ID_KELAS.required" => "The kelas name field is required",
                "JUMLAH_DEPOSIT.required" => "The packet field is required",
                "JUMLAH_DEPOSIT.numeric" =>
                    "Inputan Jumlah Uang Hanya Boleh Angka",
                "JUMLAH_UANG.required" => "Jumlah Uang Masih Kosong",
            ]
        );

        $datadepoclass = TransaksiDepositKelas::where(
            "ID_MEMBER",
            $request->ID_MEMBER
        )
            ->orderby("ID_TRANSAKSI_KELAS", "desc")
            ->first();

        $member_check_activate = Member::where("ID_MEMBER", $request->ID_MEMBER)
            ->where("MASA_AKTIVASI", "!=", null)
            ->where("MASA_AKTIVASi", ">=", Carbon::now())
            ->first();
        if (!$member_check_activate) {
            return redirect()
                ->intended("dashboard/transaksiDepositKelas")
                ->with([
                    "error" =>
                        "Member Tidak Aktif. Tolong Aktivasi Terlebih Dahulu",
                ]);
        }

        $member_deposit = MemberDepo::where("ID_MEMBER", $request->ID_MEMBER)
            ->where("ID_KELAS", $request->ID_KELAS)
            ->first();
        if ($member_deposit) {
            if (
                ($member_deposit->MASA_BERLAKU < Carbon::now() &&
                    $member_deposit->SISA_DEPO != 0) ||
                ($member_deposit->MASA_BERLAKU > Carbon::now() &&
                    $member_deposit->SISA_DEPO == 0) ||
                ($member_deposit->MASA_BERLAKU < Carbon::now() &&
                    $member_deposit->SISA_DEPO == 0)
            ) {
                $member_deposit->SISA_DEPO = 0;
                $member_deposit->MASA_BERLAKU = null;
                $member_deposit->update();
            } else {
                return redirect()
                    ->intended("dashboard/transaksiDepositKelas")
                    ->with([
                        "error" =>
                            "Member telah melakukan deposit kelas tersebut. Member tidak bisa deposit kelas sebelum tanggal expired atau deposit yang tersedia 0",
                    ]);
            }
        }

        if ($request->JUMLAH_DEPOSIT == 5 || $request->JUMLAH_DEPOSIT == 10) {
            $promo = Promo::where(
                "MINIMAL_BELI",
                $request->JUMLAH_DEPOSIT
            )->first();
            if ($promo) {
                if ($promo->MINIMAL_BELI == 5) {
                    $month = 1;
                } else {
                    $month = 2;
                }
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

        $kelas = Kelas::where("ID_KELAS", $request->ID_KELAS)->first();

        if (
            $request->JUMLAH_UANG <
            $kelas->TARIF_KELAS * $request->JUMLAH_DEPOSIT
        ) {
            return redirect()
                ->back()
                ->with(["error" => "Uang Anda Masih Kurang"]);
        }

        $datadepoclass = TransaksiDepositKelas::create([
            "ID_MEMBER" => $request->ID_MEMBER,
            "ID_PROMO" => $idPromo,
            "ID_PEGAWAI" => Auth::guard("pegawai")->user()->ID_PEGAWAI,
            "ID_KELAS" => $request->ID_KELAS,
            "JUMLAH_DEPOSIT" => $request->JUMLAH_DEPOSIT,
            "TANGGAL_TRANSAKSI_KELAS" => Carbon::now(),
            "BONUS_DEPOSIT_KELAS" => $bonus,
            "TOTAL_DEPOSIT_KELAS" => $request->JUMLAH_DEPOSIT + $bonus,
            "JUMLAH_BAYAR" => $kelas->TARIF_KELAS * $request->JUMLAH_DEPOSIT,
            "MASA_BERLAKU_KELAS" => Carbon::now()->addMonths($month),
            "KEMBALIAN" =>
                $request->JUMLAH_UANG -
                $kelas->TARIF_KELAS * $request->JUMLAH_DEPOSIT,
        ]);

        if ($datadepoclass) {
            $member_deposit2 = MemberDepo::where(
                "ID_MEMBER",
                $request->ID_MEMBER
            )
                ->where("ID_KELAS", $request->ID_KELAS)
                ->first();

            if ($member_deposit2) {
                $member_deposit2->SISA_DEPO = $request->JUMLAH_DEPOSIT + $bonus;
                $member_deposit2->MASA_BERLAKU = Carbon::now()->addMonths(
                    $month
                );
                $member_deposit2->update();
            } else {
                $member_deposit_create = MemberDepo::create([
                    "ID_MEMBER" => $request->ID_MEMBER,
                    "ID_KELAS" => $request->ID_KELAS,
                    "SISA_DEPO" => $request->JUMLAH_DEPOSIT + $bonus,
                    "MASA_BERLAKU" => Carbon::now()->addMonths($month),
                ]);
            }

            $data = TransaksiDepositKelas::latest(
                "ID_TRANSAKSI_KELAS"
            )->first();
            return redirect()->intended("dashboard/transaksiDepositKelas");
        } else {
            return redirect()
                ->intended("dashboard/transaksiDepositKelas")
                ->with(["error" => "Tidak Berhasil Deposit Member"]);
        }
    }

    public function indexDepoKelas(Request $request)
    {
        $this->validate(
            $request,
            [
                "ID_MEMBER" => ["required"],
                "ID_KELAS" => ["required"],
                "JUMLAH_DEPOSIT" => ["required", "numeric"],
            ],
            [
                "ID_MEMBER.required" => "The member name field is required",
                "ID_KELAS.required" => "The kelas name field is required",
                "JUMLAH_DEPOSIT.required" => "The packet field is required",
                "JUMLAH_DEPOSIT.numeric" => "Format packet is numeric",
            ]
        );

        $member = Member::where("ID_MEMBER", $request->ID_MEMBER)->first();
        $kelas = Kelas::where("ID_KELAS", $request->ID_KELAS)->first();

        return view("transaksiKelas/inputKelas")->with([
            "user" => Auth::guard("pegawai")->user(),
            "member" => $member,
            "ID_KELAS" => $request->ID_KELAS,
            "NAMA_KELAS" => $kelas->NAMA_KELAS,
            "JUMLAH_DEPOSIT" => $request->JUMLAH_DEPOSIT,
            "BIAYA" => $request->JUMLAH_DEPOSIT * $kelas->TARIF_KELAS,
        ]);
    }

    public function cetakStrukDepositKelas($id)
    {
        $transaksiKelas = TransaksiDepositKelas::where(
            "ID_TRANSAKSI_KELAS",
            $id
        )->first();
        return view("transaksiKelas/cetakStrukKelas")->with([
            "transaksiKelas" => $transaksiKelas,
        ]);
    }
}
