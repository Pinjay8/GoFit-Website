<?php

namespace App\Http\Controllers;

use App\Models\BookingGym;
use App\Models\Member;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class BookingGymController extends Controller
{
    //

    public function index(Request $request)
    {
        if ($request->accepts("text/html")) {
            $booking_gym = BookingGym::orderBy("KODE_BOOKING_GYM", "desc")
                ->where("STATUS_PRESENSI_GYM", null)
                ->get();
            $booking_gym_after = BookingGym::orderBy("KODE_BOOKING_GYM", "desc")
                ->where("STATUS_PRESENSI_GYM", "!=", null)
                ->get();

            return view("BookingGym/index")->with([
                "user" => Auth::guard("pegawai")->user(),
                "booking_gym" => $booking_gym,
                "booking_gym_after" => $booking_gym_after,
            ]);
        }
    }

    public function indexBookingGym($id)
    {
        $bookingGym = BookingGym::where("ID_MEMBER", $id)->get();

        if ($bookingGym) {
            return response(
                [
                    "message" => "Berhasil mengambil data booking gym",
                    "data" => $bookingGym,
                ],
                200
            );
        }
        return response(
            [
                "message" => "Tidak berhasil mengambil data booking gym",
                "data" => null,
            ],
            200
        );
    }

    public function store(Request $request)
    {
        if ($request->expectsJson()) {
            $validate = Validator::make($request->all(), [
                "ID_MEMBER" => ["required"],
                "SLOT_WAKTU" => ["required"],
                "TANGGAL_BOOKING_GYM" => ["required"],
            ]);

            if ($validate->fails()) {
                return response(
                    ["success" => false, "message" => $validate->errors()],
                    400
                );
            }

            if (
                $request->TANGGAL_BOOKING_GYM < Carbon::now()->format("Y-m-d")
            ) {
                return response(
                    [
                        "message" =>
                            "please input date more than or same date now ",
                        "data" => null,
                    ],
                    400
                );
            }

            $member = Member::where("ID_MEMBER", $request->ID_MEMBER)->first();

            if (
                $member->MASA_AKTIVASI == null ||
                $member->MASA_AKTIVASI < Carbon::now()
            ) {
                return response(
                    [
                        "message" => "You not activated ",
                        "data" => null,
                    ],
                    400
                );
            }

            $check_duplicate = BookingGym::where(
                "ID_MEMBER",
                $request->ID_MEMBER
            )
                ->where("TANGGAL_BOOKING_GYM", $request->TANGGAL_BOOKING_GYM)
                ->where("SLOT_WAKTU", $request->SLOT_WAKTU)
                ->first();
            if ($check_duplicate) {
                return response(
                    [
                        "message" => "You have been booking this class",
                        "data" => null,
                    ],
                    400
                );
            }

            $checkGym = BookingGym::where("SLOT_WAKTU", $request->SLOT_WAKTU)
                ->where("TANGGAL_BOOKING_GYM", $request->TANGGAL_BOOKING_GYM)
                ->count();

            if ($checkGym <= 10) {
                $data = BookingGym::create([
                    "ID_MEMBER" => $request->ID_MEMBER,
                    "TANGGAL_BOOKING_GYM" => $request->TANGGAL_BOOKING_GYM,
                    "TANGGAL_YANG_DIBOOKING_GYM" => Carbon::now(),
                    "SLOT_WAKTU" => $request->SLOT_WAKTU,
                    "WAKTU_PRESENSI" => null,
                    "STATUS_PRESENSI_GYM" => null,
                ]);

                if ($data) {
                    return response(
                        [
                            "message" => "Succesfully create data",
                            "data" => $data,
                        ],
                        200
                    );
                }
            } else {
                return response(
                    [
                        "message" => "Failed create store booking gym",
                        "data" => null,
                    ],
                    400
                );
            }
        }
    }

    public function batalGym(Request $request, $id)
    {
        if ($request->expectsJson()) {
            $bookingGym = BookingGym::where("KODE_BOOKING_GYM", $id)->first();

            if ($bookingGym) {
                if (
                    Carbon::now()->format("Y-m-d") <=
                    Carbon::parse($bookingGym->TANGGAL_BOOKING_GYM)->subDays(1)
                ) {
                    $bookingGym->delete();
                    return response(
                        [
                            "message" => "Succesfully cancel bookingGym",
                            "data" => $bookingGym,
                        ],
                        200
                    );
                } else {
                    return response(
                        [
                            "message" =>
                                "You can cancel bookingGym class max h-1 day",
                            "data" => null,
                        ],
                        400
                    );
                }

                return response(
                    [
                        "message" => "Failed cancel bookingGym",
                        "data" => null,
                    ],
                    400
                );
            }
        }
    }

    public function konfirmasiGym(Request $request, $id)
    {
        if ($request->accepts("text/html")) {
            $bookingGym = BookingGym::where("KODE_BOOKING_GYM", $id)->first();
            if ($bookingGym) {
                $bookingGym->WAKTU_PRESENSI = Carbon::now();
                $bookingGym->STATUS_PRESENSI_GYM = "Hadir";
                $bookingGym->update();
                return redirect()
                    ->intended("dashboard/presensiBookingGym")
                    ->with(["success" => "Successfully confirm booking gym"]);
            }
            return redirect()
                ->intended("dashboard/presensiBookingGym")
                ->with(["error" => "Failed confirm booking gym"]);
        }
    }

    public function cetakStrukPresensiGym($id)
    {
        $presensies = BookingGym::where("KODE_BOOKING_GYM", $id)->first();
        return view("BookingGym/cetakStruk")->with([
            "booking_gym" => $presensies,
        ]);
    }
}
