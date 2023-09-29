<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Member;
use App\Models\Instruktur;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Session;

class LoginController extends Controller
{
    //Halaman Awal Website
    public function homepage()
    {
        return view("index");
    }

    public function login()
    {
        if ($pegawai = Auth::guard("pegawai")->user()) {
            return redirect()->intended("dashboard/main");
        }
        return view("login");
    }

    public function signup()
    {
        return view("register");
    }

    public function forgotPassword()
    {
        return view("forgotPassword")->with([
            "user" => Auth::guard("pegawai")->user(),
        ]);
    }

    public function loginUser(Request $request)
    {
        $data = $request->only("Email", "password");
        $credentials = Validator::make(
            $data,
            [
                "Email" => ["required", "email:rfc,dns"],
                "password" => ["required"],
            ],
            [
                "Email.required" => "Email Tidak Boleh Kosong",
                "Email.email" => "Email harus menggunakan format @",
                "password" => "Password Tidak Boleh Kosong",
            ]
        );

        if ($credentials->fails()) {
            return response(
                ["success" => false, "message" => $credentials->errors()],
                400
            );
        }

        $cekPegawai = Pegawai::where("EMAIL_PEGAWAI", $request->Email)
            ->where("ROLE_PEGAWAI", "Manajer Operasional")
            ->first();
        $cekMember = Member::where("EMAIL_MEMBER", $request->Email)->first();
        $cekInstruktur = Instruktur::where(
            "EMAIL_INSTRUKTUR",
            $request->Email
        )->first();

        if (
            $cekPegawai &&
            Hash::check($request->password, $cekPegawai->password)
        ) {
            if (
                Auth::guard("pegawai")->attempt([
                    "EMAIL_PEGAWAI" => $request->Email,
                    "password" => $request->password,
                ])
            ) {
                $pegawai = Auth::guard("pegawai")->user();
                $token = $pegawai->createToken("Authentication Token")
                    ->accessToken;
                return response(
                    [
                        "message" => "Authenticated",
                        "user" => $pegawai,
                        "token_type" => "Bearer",
                        "access_token" => $token,
                    ],
                    200
                );
            }
            return response(
                [
                    "message" => "Invalid Credentials",
                    "user" => null,
                ],
                400
            );
        } elseif (
            $cekMember &&
            Hash::check($request->password, $cekMember->password)
        ) {
            if (
                Auth::guard("member")->attempt([
                    "EMAIL_MEMBER" => $request->Email,
                    "password" => $request->password,
                ])
            ) {
                $member = Auth::guard("member")->user();
                $token = $member->createToken("Authentication Token")
                    ->accessToken;
                return response(
                    [
                        "message" => "Authenticated",
                        "user" => $member,
                        "token_type" => "Bearer",
                        "access_token" => $token,
                    ],
                    200
                );
            }
            return response(
                [
                    "message" => "Invalid Credentials",
                    "user" => null,
                ],
                400
            );
        } elseif (
            $cekInstruktur &&
            Hash::check($request->password, $cekInstruktur->password)
        ) {
            if (
                Auth::guard("instruktur")->attempt([
                    "EMAIL_INSTRUKTUR" => $request->Email,
                    "password" => $request->password,
                ])
            ) {
                $instruktur = Auth::guard("instruktur")->user();
                $token = $instruktur->createToken("Authentication Token")
                    ->accessToken;
                return response(
                    [
                        "message" => "Authenticated",
                        "user" => $instruktur,
                        "token_type" => "Bearer",
                        "access_token" => $token,
                    ],
                    200
                );
            }
            return response(
                [
                    "message" => "Invalid Credentials",
                    "user" => null,
                ],
                400
            );
        } else {
            return response(
                [
                    "message" => "Invalid Credentials",
                    "user" => null,
                ],
                400
            );
        }
    }

    public function login_process(Request $request)
    {
        if ($request->accepts("text/html")) {
            $validate = $request->validate(
                [
                    "EMAIL_PEGAWAI" => ["required", "email:rfc,dns"],
                    "password" => ["required"],
                ],
                [
                    "EMAIL_PEGAWAI.required" =>
                        "Email pegawai tidak boleh kosong",
                    "EMAIL_PEGAWAI.email" => "Email harus berformat email @",
                    "password" => "Password Pegawai tidak boleh kosong",
                ]
            );

            $credential = $request->only("EMAIL_PEGAWAI", "password");

            if (Auth::guard("pegawai")->attempt($credential)) {
                $request->session()->regenerate();
                $user = Auth::guard("pegawai")->user();

                if ($user) {
                    return redirect()
                        ->intended("dashboard/main")
                        ->with("success", "Selamat Anda Berhasil Login");
                }
            }
            return redirect()
                ->intended("login")
                ->with("error", "Invalid Credential");
        } else {
            // if ($request->has("EMAIL_PEGAWAI", "password")) {
            //     $data = $request->all();
            //     $credentials = Validator::make(
            //         $data,
            //         [
            //             "EMAIL_PEGAWAI" => ["required", "email:rfc,dns"],
            //             "password" => ["required"],
            //         ],
            //         [
            //             "EMAIL_PEGAWAI.required" =>
            //                 "Email pegawais tidak boleh kosong",
            //             "EMAIL_PEGAWAI.email" => "Harus berformat email @",
            //             "password" => "Password pegawais tidak boleh kosong",
            //         ]
            //     );
            //     if ($credentials->fails()) {
            //         return response(
            //             [
            //                 "success" => false,
            //                 "message" => $credentials->errors(),
            //             ],
            //             400
            //         );
            //     }

            //     if (Auth::guard("pegawai")->attempt($data)) {
            //         $pegawais = Auth::guard("pegawai")->user();
            //         $token = $pegawais->createToken("Authentication Token")
            //             ->accessToken;
            //         return response([
            //             "message" => "Authenticated",
            //             "user" => $pegawais,
            //             "token_type" => "Bearer",
            //             "access_token" => $token,
            //         ]);
            //     }
            //     return response(["message" => "Invalid Credentials"], 401);
            // } elseif ($request->has("EMAIL_MEMBER", "password")) {
            //     $data = $request->all();
            //     $credentials = Validator::make(
            //         $data,
            //         [
            //             "EMAIL_MEMBER" => ["required"],
            //             "password" => ["required"],
            //         ],
            //         [
            //             "EMAIL_MEMBER.required" =>
            //                 "Email member tidak boleh kosong",
            //             "EMAIL_MEMBER.email" => "Harus berformat email @",
            //             "password" => "Password member tidak boleh kosong",
            //         ]
            //     );
            //     if ($credentials->fails()) {
            //         return response(
            //             [
            //                 "success" => false,
            //                 "message" => $credentials->errors(),
            //             ],
            //             400
            //         );
            //     }

            //     // if (!Auth::guard("member")->attempt($data)) {
            //     //     return response(["message" => "Invalid Credentials"], 401);
            //     // }

            //     if (Auth::guard("member")->attempt($data)) {
            //         $members = Auth::guard("member")->user();
            //         $token = $members->createToken("Authentication Token")
            //             ->accessToken;
            //     }

            //     return response([
            //         "message" => "Authenticated",
            //         "user" => $members,
            //         "token_type" => "Bearer",
            //         "access_token" => $token,
            //     ]);
            //     return response(["message" => "Invalid Credentials"], 401);
            // } else {
            //     if ($request->has("EMAIL_INSTRUKTUR", "password")) {
            //         $data = $request->all();
            //         $credentials = Validator::make(
            //             $data,
            //             [
            //                 "EMAIL_INSTRUKTUR" => ["required", "email:rfc,dns"],
            //                 "password" => ["required"],
            //             ],
            //             [
            //                 "EMAIL_INSTRUKTUR.required" =>
            //                     "Email Instruktur tidak boleh kosong",
            //                 "EMAIL_INSTRUKTUR.email" =>
            //                     "Harus berformat email @",
            //                 "password" => "Password member tidak boleh kosong",
            //             ]
            //         );
            //         if ($credentials->fails()) {
            //             return response(
            //                 [
            //                     "success" => false,
            //                     "message" => $credentials->errors(),
            //                 ],
            //                 400
            //             );
            //         }
            //         if (!Auth::guard("instruktur")->attempt($data)) {
            //             return response(
            //                 ["message" => "Invalid Credentials"],
            //                 401
            //             );
            //         }

            //         if (Auth::guard("instruktur")->attempt($data)) {
            //             $instrukturs = Auth::guard("instruktur")->user();
            //             $token = $instrukturs->createToken(
            //                 "Authentication Token"
            //             )->accessToken;
            //         }

            //         return response([
            //             "message" => "Authenticated",
            //             "user" => $instrukturs,
            //             "token_type" => "Bearer",
            //             "access_token" => $token,
            //         ]);
            //     }
            // }

            $data = $request->only("Email", "password");
            $credentials = Validator::make(
                $data,
                [
                    "Email" => ["required", "email:rfc,dns"],
                    "password" => ["required"],
                ],
                [
                    "Email.required" => "The email field is required",
                    "Email.email" => "Email using format @",
                    "password" => "The password field is required",
                ]
            );

            if ($credentials->fails()) {
                return response(
                    ["success" => false, "message" => $credentials->errors()],
                    400
                );
            }

            $cekPegawai = Pegawai::where("EMAIL_PEGAWAI", $request->Email)
                ->where("ROLE_PEGAWAI", "Manajer Operasional")
                ->first();
            $cekMember = Member::where(
                "EMAIL_MEMBER",
                $request->Email
            )->first();
            $cekInstruktur = Instruktur::where(
                "EMAIL_INSTRUKTUR",
                $request->Email
            )->first();

            if (
                $cekPegawai &&
                Hash::check($request->password, $cekPegawai->password)
            ) {
                if (
                    Auth::guard("pegawai")->attempt([
                        "EMAIL_PEGAWAI" => $request->Email,
                        "password" => $request->password,
                    ])
                ) {
                    $pegawai = Auth::guard("pegawai")->user();
                    $token = $pegawai->createToken("Authentication Token")
                        ->accessToken;
                    return response(
                        [
                            "message" => "Authenticated",
                            "user" => $pegawai,
                            "token_type" => "Bearer",
                            "access_token" => $token,
                        ],
                        200
                    );
                }
                return response(
                    [
                        "message" => "Invalid Credentials",
                        "user" => null,
                    ],
                    400
                );
            } elseif (
                $cekMember &&
                Hash::check($request->password, $cekMember->password)
            ) {
                if (
                    Auth::guard("member")->attempt([
                        "EMAIL_MEMBER" => $request->Email,
                        "password" => $request->password,
                    ])
                ) {
                    $member = Auth::guard("member")->user();
                    $token = $member->createToken("Authentication Token")
                        ->accessToken;
                    return response(
                        [
                            "message" => "Authenticated",
                            "user" => $member,
                            "token_type" => "Bearer",
                            "access_token" => $token,
                        ],
                        200
                    );
                }
                return response(
                    [
                        "message" => "Invalid Credentials",
                        "user" => null,
                    ],
                    400
                );
            } elseif (
                $cekInstruktur &&
                Hash::check($request->password, $cekInstruktur->password)
            ) {
                if (
                    Auth::guard("instruktur")->attempt([
                        "EMAIL_INSTRUKTUR" => $request->Email,
                        "password" => $request->password,
                    ])
                ) {
                    $instruktur = Auth::guard("instruktur")->user();
                    $token = $instruktur->createToken("Authentication Token")
                        ->accessToken;
                    return response(
                        [
                            "message" => "Authenticated",
                            "user" => $instruktur,
                            "token_type" => "Bearer",
                            "access_token" => $token,
                        ],
                        200
                    );
                }
                return response(
                    [
                        "message" => "Invalid Credentials",
                        "user" => null,
                    ],
                    400
                );
            } else {
                return response(
                    [
                        "message" => "Invalid Credentials",
                        "user" => null,
                    ],
                    400
                );
            }
        }
    }

    public function storeForgotPassword(Request $request)
    {
        $validate = $request->validate([
            "EMAIL_PEGAWAI" => ["required"],
        ]);

        $pegawai = Pegawai::where(
            "EMAIL_PEGAWAI",
            $request->EMAIL_PEGAWAI
        )->first();

        if ($pegawai) {
            return view("resetPassword")->with([
                "user" => Auth::guard("pegawai")->user(),
                "pegawai" => $pegawai,
            ]);
        }
        return redirect()
            ->intended("forgotPassword")
            ->with(["error" => "Mohon maaf, Email tidak tersedia"]);
    }

    public function updateForgotPassword(Request $request, $id)
    {
        $pegawai = Pegawai::where("ID_PEGAWAI", $id)->first();

        if ($request->password) {
            $pegawai->password = \bcrypt($request->password);
        }

        $pegawaiUpdate = Pegawai::where("ID_PEGAWAI", $id)
            ->limit(1)
            ->update([
                "password" => $pegawai->password,
            ]);

        if ($pegawaiUpdate) {
            return redirect()
                ->intended("login")
                ->with(["success" => "Berhasil mengubah data pegawai"]);
        }
    }

    public function logout(Request $request)
    {
        if ($request->accepts("text/html")) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect("login")->with("success", "Berhasil Logout");
        } else {
            $user = Auth::user()->token();
            $user->revoke();

            return response([
                "message" => "Berhasil Logout",
                "user" => $user,
            ]); //retun data user dan token dalam bentuk json
        }
    }

    public function gantiPassword(Request $request)
    {
        $data = $request->only("Email", "password");
        $credentials = Validator::make(
            $data,
            [
                "Email" => ["required", "email:rfc,dns"],
                "password" => ["required"],
            ],
            [
                "Email.required" => "The email field is required",
                "Email.email" => "Email using format @",
                "password" => "The password field is required",
            ]
        );

        if ($credentials->fails()) {
            return response(
                ["success" => false, "message" => $credentials->errors()],
                400
            );
        }
        $pegawai_exists = Pegawai::where("EMAIL_PEGAWAI", $request->Email)
            ->where("ROLE_PEGAWAI", "Manajer Operasional")
            ->first();
        $member_exists = Member::where(
            "EMAIL_MEMBER",
            $request->Email
        )->first();
        $instructor_exists = Instruktur::where(
            "EMAIL_INSTRUKTUR",
            $request->Email
        )->first();

        if ($member_exists) {
            return response(
                [
                    "message" =>
                        "Member tidak boleh ganti password. Tolong Kontak Kasir",
                    "user" => null,
                ],
                400
            );
        } elseif ($pegawai_exists) {
            $pegawai_exists->password = \bcrypt($request->password);
            $pegawai_exists->update();
            return response(
                [
                    "message" => "Berhasil mengganti password pegawai",
                    "user" => $pegawai_exists,
                ],
                200
            );
        } elseif ($instructor_exists) {
            $instructor_exists->password = \bcrypt($request->password);
            $instructor_exists->update();
            return response(
                [
                    "message" => "Berhasil mengganti password instruktur",
                    "user" => $instructor_exists,
                ],
                200
            );
        }
        return response(
            [
                "message" =>
                    "User tidak berhasil ditemukan, Tolong masukkan data yang benar",
                "user" => null,
            ],
            400
        );
    }
}
