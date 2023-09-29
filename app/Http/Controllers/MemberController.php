<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MemberDepo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexMemberDeaktif()
    {
        $member = Member::orderby("ID_MEMBER", "desc")
            ->where("MASA_AKTIVASI", "<", Carbon::now())
            ->get();

        return view("member/memberDeaktif")->with([
            "user" => Auth::guard("pegawai")->user(),
            "member" => $member,
        ]);
    }

    public function deaktifProcess()
    {
        $member = member::where("MASA_AKTIVASI", "<", Carbon::now())->get();
        if ($member) {
            foreach ($member as $item) {
                $item->MASA_AKTIVASI = null;
                $item->SISA_DEPOSIT_KELAS = 0;
                $item->SISA_DEPOSIT_UANG = 0;
                $item->MASA_EXPIRED = null;
                $item->TGL_NONAKTIF = Carbon::now()->addDays(1);
                $item->update();
            }
            return redirect()
                ->intended("dashboard/memberDeaktif")
                ->with(["success" => "Sucessfully deactive member"]);
        }
        return redirect()
            ->intended("dashboard/memberDeaktif")
            ->with(["error" => "Failed deactive member"]);
    }

    // public function indexResetKelas()
    // {
    //     $member = Member::orderby("ID_MEMBER", "desc")
    //         ->where("MASA_EXPIRED", "<", Carbon::now())
    //         ->get();

    //     return view("member/kelasReset")->with([
    //         "user" => Auth::guard("pegawai")->user(),
    //         "member" => $member,
    //     ]);
    // }

    public function indexResetKelas()
    {
        $member = MemberDepo::orderby("ID_MEMBER_DEPO", "desc")
            ->where("MASA_BERLAKU", "<", Carbon::now())
            ->paginate(5);
        $member_after = MemberDepo::orderby("ID_MEMBER_DEPO", "desc")
            ->where("MASA_BERLAKU", null)
            ->paginate(5);

        return view("member/kelasReset")->with([
            "user" => Auth::guard("pegawai")->user(),
            "member" => $member,
            "members_after" => $member_after,
        ]);
    }

    // public function resetKelas($id)
    // {
    //     $member = Member::orderby("ID_MEMBER", "desc")
    //         ->where("MASA_EXPIRED", "<", Carbon::now())
    //         ->paginate(5);

    //     $member = Member::where("ID_MEMBER", $id)->first();
    //     if (
    //         ($member && $member->TGL_RESET_KELAS < Carbon::now()) ||
    //         ($member && $member->TGL_RESET_KELAS == null)
    //     ) {
    //         $member->MASA_AKTIVASI = null;
    //         $member->SISA_DEPOSIT_KELAS = 0;
    //         $member->SISA_DEPOSIT_UANG = 0;
    //         $member->MASA_EXPIRED = null;
    //         $member->TGL_RESET_KELAS = Carbon::now()->addDays(1);
    //         $member->update();
    //         return redirect()
    //             ->intended("dashboard/resetKelas")
    //             ->with([
    //                 "success" => "Berhasil mendeaktif member",
    //             ]);
    //     }
    //     return redirect()
    //         ->intended("dashboard/resetKelas")
    //         ->with([
    //             "error" => "Gagal deaktif member",
    //         ]);
    // }

    public function resetKelas()
    {
        $members = MemberDepo::orderby("ID_MEMBER_DEPO", "desc")
            ->where("MASA_BERLAKU", "<", Carbon::now())
            ->get();
        if ($members) {
            foreach ($members as $member) {
                if (
                    $member->EXPIRED_KELAS < Carbon::now() ||
                    ($member && $member->EXPIRED_KELAS == null)
                ) {
                    $member->SISA_DEPO = 0;
                    $member->MASA_BERLAKU = null;
                    $member->EXPIRED_KELAS = Carbon::now()->addDays(1);
                    $member->update();
                } else {
                    return redirect()
                        ->intended("dashboard/resetKelas")
                        ->with([
                            "error" =>
                                "Failed reset class member " .
                                $member->member->NAMA_MEMBER .
                                " class " .
                                $member->kelas->NAMA_KELAS .
                                " because you can deactive this member tomorrow",
                        ]);
                }
            }
            return redirect()
                ->intended("dashboard/resetKelas")
                ->with(["success" => "Sucessfully reset class packet"]);
        }
        return redirect()
            ->intended("dashboard/resetKelas")
            ->with(["error" => "Member not found"]);
    }

    public function index()
    {
        //Tampilan Awal Member

        $member = Member::paginate(5);
        return view("member/index")->with([
            "user" => Auth::guard("pegawai")->user(),
            "members" => $member,
        ]);
    }

    public function indexMember()
    {
        $Members = Member::all();

        if (count($Members) > 0) {
            return response(
                [
                    "message" => "Retrieve All Success",
                    "data" => $Members,
                ],
                200
            );
        }

        return response(
            [
                "message" => "Data is Empty",
                "data" => null,
            ],
            400
        );
    }

    public function getDataMember(Request $request, $id)
    {
        if ($request->expectsjson()) {


            $members = DB::select(
                'SELECT m.ID_MEMBER, m.NAMA_MEMBER, m.EMAIL_MEMBER, m.MASA_AKTIVASI, m.SISA_DEPOSIT_UANG, md.SISA_DEPO FROM member m LEFT JOIN member_deposit md ON m.ID_MEMBER = md.ID_MEMBER  WHERE m.ID_MEMBER = "' .
                    $id .
                    '" GROUP BY m.NAMA_MEMBER, md.SISA_DEPO '
            );

            if ($members) {
                return response(
                    [
                        "message" => "Berhasil mengambil data member",
                        "data" => $members,
                    ],
                    200
                );
            }

            return response(
                [
                    "message" => "Member tidak ditemukan",
                    "data" => null,
                ],
                200
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Tampilan Create Member
        return view("member/create")->with([
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
        $validate = $request->validate([
            "NAMA_MEMBER" => ["required"],
            "NO_TELPON_MEMBER" => ["required"],
            "USIA_MEMBER" => ["required"],
            "ALAMAT_MEMBER" => ["required"],
            "JENIS_KELAMIN_MEMBER" => ["required"],
            "TANGGAL_LAHIR_MEMBER" => ["required"],
            // "MASA_AKTIVASI" => ["required"],
            // "SISA_DEPOSIT_MEMBER" => ["required"],
            // "SISA_DEPOSIT_KELAS" => ["required"],
            "EMAIL_MEMBER" => ["required"],
            "password" => ["required"],
        ]);

        $dataMember = $request->all();

        $dataMember["password"] = \bcrypt($request->password);
        $dataMember["MASA_AKTIVASI"] = null;
        $dataMember["SISA_DEPOSIT_UANG"] = 0;
        $dataMember["SISA_DEPOSIT_KELAS"] = 0;

        $member = Member::create($dataMember);

        if ($member) {
            return redirect()
                ->intended("dashboard/member")
                ->with(["success" => "Berhasil Menambah Member"]);
        }
        return redirect()
            ->intended("dashboard/createMember")
            ->with(["error" => "Tidak Berhasil Menambah member"]);
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
            $member = Member::orderby("ID_MEMBER", "ASC")->paginate(5);
        } else {
            $member = Member::where("NAMA_MEMBER", $request->keyword)
                ->orWhere("ID_MEMBER", $request->keyword)
                ->orWhere("NO_TELPON_MEMBER", $request->keyword)
                ->orWhere("USIA_MEMBER", $request->keyword)
                ->orWhere("ALAMAT_MEMBER", $request->keyword)
                ->orWhere("JENIS_KELAMIN_MEMBER", $request->keyword)
                ->orWhere("MASA_AKTIVASI", $request->keyword)
                ->orWhere("SISA_DEPOSIT_UANG", $request->keyword)
                ->orWhere("SISA_DEPOSIT_KELAS", $request->keyword)
                ->paginate(5);
        }
        return view("member/index")->with([
            "user" => Auth::guard("pegawai")->user(),
            "members" => $member,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resetPassword($id)
    {
        //
        $member = Member::where("ID_MEMBER", $id)->first();

        $member->update(["password" => bcrypt($member->TANGGAL_LAHIR_MEMBER)]);

        if ($member) {
            return redirect()
                ->intended("dashboard/member")
                ->with(["sucesss" => "Member berhasil reset password"]);
        } else {
            return redirect()
                ->intended("dashboard/member")
                ->with(["sucesss" => "Member berhasil reset password"]);
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
        //Mengubah
        $member = Member::where("ID_MEMBER", $id)->first();

        return view("member/edit")->with([
            "user" => Auth::guard("pegawai")->user(),
            "member" => $member,
        ]);
    }

    public function cetakCardMember($id)
    {
        //Mengubah
        $member = Member::where("ID_MEMBER", $id)->first();

        return view("member/card")->with([
            "member" => $member,
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
        $member = Member::where("ID_MEMBER", $id)->first();

        if ($request->NAMA_MEMBER) {
            $member->NAMA_MEMBER = $request->NAMA_MEMBER;
        }
        if ($request->NO_TELPON_MEMBER) {
            $member->NO_TELPON_MEMBER = $request->NO_TELPON_MEMBER;
        }

        if ($request->USIA_MEMBER) {
            $member->USIA_MEMBER = $request->USIA_MEMBER;
        }

        if ($request->ALAMAT_MEMBER) {
            $member->ALAMAT_MEMBER = $request->ALAMAT_MEMBER;
        }

        if ($request->JENIS_KELAMIN_MEMBER) {
            $member->JENIS_KELAMIN_MEMBER = $request->JENIS_KELAMIN_MEMBER;
        }

        if ($request->TANGGAL_LAHIR_MEMBER) {
            $member->TANGGAL_LAHIR_MEMBER = $request->TANGGAL_LAHIR_MEMBER;
        }

        if ($request->SISA_DEPOSIT_UANG) {
            $member->SISA_DEPOSIT_UANG = $request->SISA_DEPOSIT_UANG;
        }

        if ($request->SISA_DEPOSIT_KELAS) {
            $member->SISA_DEPOSIT_KELAS = $request->SISA_DEPOSIT_KELAS;
        }

        if ($request->EMAIL_MEMBER) {
            $member->EMAIL_MEMBER = $request->EMAIL_MEMBER;
        }
        if ($request->password) {
            $member->password = \bcrypt($request->password);
        }

        $memberUpdate = Member::where("ID_MEMBER", $id)
            ->limit(1)
            ->update([
                "NAMA_MEMBER" => $member->NAMA_MEMBER,
                "NO_TELPON_MEMBER" => $member->NO_TELPON_MEMBER,
                "USIA_MEMBER" => $member->USIA_MEMBER,
                "ALAMAT_MEMBER" => $member->ALAMAT_MEMBER,
                "JENIS_KELAMIN_MEMBER" => $member->JENIS_KELAMIN_MEMBER,
                "TANGGAL_LAHIR_MEMBER" => $member->TANGGAL_LAHIR_MEMBER,
                "EMAIL_MEMBER" => $member->EMAIL_MEMBER,
                "password" => $member->password,
            ]);

        // $member->update();

        if ($memberUpdate) {
            return redirect()
                ->intended("dashboard/member")
                ->with(["success" => "Berhasil mengubah data member"]);
        }
        return redirect()
            ->intended("dashboard/editMember/" . $id)
            ->with(["error" => "Tidak berhasil mengubah data member"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::where("ID_MEMBER", $id);

        $member->delete();

        if ($member) {
            return redirect()
                ->intended("dashboard/member")
                ->with(["sucesss" => "Member berhasil dihapus"]);
        } else {
            return redirect()
                ->intended("dashboard/member")
                ->with(["error" => "Member tidak berhasil dihapus"]);
        }
    }
}
