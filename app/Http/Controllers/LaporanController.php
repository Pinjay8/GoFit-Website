<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiDepositKelas;
use App\Models\TransaksiDepositUang;
use App\Models\TransaksiAktivasi;
use App\Models\BookingGym;
use App\Models\BookingKelas;
use App\Models\JadwalHarian;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LaporanController extends Controller
{
    // public function getLaporanPendapatan(Request $request)
    // {
    //     $tahun_transaksi_aktivasi = $request->input("tahun");

    //     $total_transaksi_aktivasi = TransaksiAktivasi::select(
    //         DB::raw(
    //             "CAST(SUM(BIAYA_AKTIVASI) as int) as total_transaksi_aktivasi"
    //         )
    //     )
    //         ->whereYear("TANGGAL_AKTIVASI", $tahun_transaksi_aktivasi)
    //         ->groupBy(DB::raw("MONTH(TANGGAL_AKTIVASI)"))
    //         ->pluck("total_transaksi_aktivasi");

    //     $total_transaksi_deposit_kelas = TransaksiDepositKelas::select(
    //         DB::raw(
    //             "MONTHNAME(TANGGAL_TRANSAKSI_KELAS) as bulan, CAST(SUM(JUMLAH_BAYAR) as int) as total_transaksi_deposit_kelas"
    //         )
    //     )
    //         ->whereYear("TANGGAL_TRANSAKSI_KELAS", $tahun_transaksi_aktivasi)
    //         ->groupBy(DB::raw("MONTHNAME(TANGGAL_TRANSAKSI_KELAS)"))
    //         ->pluck("total_transaksi_deposit_kelas", "bulan");

    //     $total_transaksi_deposit_uang = TransaksiDepositUang::select(
    //         DB::raw(
    //             "MONTHNAME(TANGGAL_TRANSAKSI_UANG) as bulan, CAST(SUM(TOTAL_DEPOSIT_UANG) as int) as total_transaksi_deposit_uang"
    //         )
    //     )
    //         ->whereYear("TANGGAL_TRANSAKSI_UANG", $tahun_transaksi_aktivasi)
    //         ->groupBy(DB::raw("MONTHNAME(TANGGAL_TRANSAKSI_UANG)"))
    //         ->pluck("total_transaksi_deposit_uang", "bulan");

    //     $bulan_transaksi_aktivasi = TransaksiAktivasi::select(
    //         DB::raw("MONTHNAME(TANGGAL_AKTIVASI) as bulan")
    //     )
    //         ->whereYear("TANGGAL_AKTIVASI", $tahun_transaksi_aktivasi)
    //         ->groupBy(DB::raw("MONTHNAME(TANGGAL_AKTIVASI)"))
    //         ->pluck("bulan");

    //     $bulan_transaksi_deposit_kelas = TransaksiDepositKelas::select(
    //         DB::raw("MONTHNAME(TANGGAL_TRANSAKSI_KELAS) as bulan")
    //     )
    //         ->whereYear("TANGGAL_TRANSAKSI_KELAS", $tahun_transaksi_aktivasi)
    //         ->groupBy(DB::raw("MONTHNAME(TANGGAL_TRANSAKSI_KELAS)"))
    //         ->pluck("bulan");

    //     $bulan_transaksi_deposit_uang = TransaksiDepositUang::select(
    //         DB::raw("MONTHNAME(TANGGAL_TRANSAKSI_UANG) as bulan")
    //     )
    //         ->whereYear("TANGGAL_TRANSAKSI_UANG", $tahun_transaksi_aktivasi)
    //         ->groupBy(DB::raw("MONTHNAME(TANGGAL_TRANSAKSI_UANG)"))
    //         ->pluck("bulan");

    //     $bulan_transaksi = $bulan_transaksi_aktivasi
    //         ->merge($bulan_transaksi_deposit_kelas)
    //         ->merge($bulan_transaksi_deposit_uang)
    //         ->unique()
    //         ->sortBy(function ($bulan) {
    //             return Carbon::parse($bulan)->month;
    //         });

    //     return view(
    //         "Laporan/LaporanPendapatan",
    //         compact(
    //             "total_transaksi_aktivasi",
    //             "total_transaksi_deposit_kelas",
    //             "total_transaksi_deposit_uang",
    //             "tahun_transaksi_aktivasi",
    //             "bulan_transaksi",
    //             "bulan_transaksi_aktivasi",
    //             "bulan_transaksi_deposit_kelas",
    //             "bulan_transaksi_deposit_uang"
    //         )
    //     )->with([
    //         "user" => Auth::guard("pegawai")->user(),
    //         "tanggal_cetak" => Carbon::now()->translatedFormat("d F Y"),
    //     ]);
    // }

    // public function aktivitasKelasBulanan(Request $request)
    // {
    //     $bulan = Carbon::now()->month;
    //     if ($request->has("month") && !empty($request->month)) {
    //         $bulan = $request->month;
    //     }

    //     $tanggalCetak = Carbon::now();
    //     $aktivitasKelas = DB::select(
    //         '
    //         SELECT k.jenis_kelas AS kelas, i.nama_instruktur AS instruktur, COUNT(bk.no_booking) AS jumlah_peserta_kelas,
    //             COUNT(CASE WHEN jh.status = "diliburkan" THEN 1 ELSE NULL END) AS jumlah_libur
    //         FROM booking_kelas AS bk
    //         JOIN jadwal_harian AS jh ON bk.id_jadwal_harian = jh.id_jadwal_harian
    //         JOIN jadwal_umum AS ju ON jh.id_jadwal_umum = ju.id_jadwal_umum
    //         JOIN instruktur AS i ON ju.id_instruktur = i.id_instruktur
    //         JOIN kelas AS k ON ju.id_kelas = k.id_kelas
    //         WHERE MONTH(jh.tanggal_jadwal_harian) = ?
    //         GROUP BY k.jenis_kelas, i.nama_instruktur
    //     ',
    //         [$bulan]
    //     );

    //     //akumulasi terlambat direset tiap bulan jam mulai tiap bulan - jam selesai bulan

    //     return response([
    //         "data" => $aktivitasKelas,
    //         "tanggal_cetak" => $tanggalCetak,
    //     ]);
    // }

    // public function aktivitasGymBulanan(Request $request)
    // {
    //     //* date
    //     $bulan = Carbon::now()->month;
    //     if ($request->has("month") && !empty($request->month)) {
    //         $bulan = $request->month;
    //     }

    //     //* Tanggal Cetak
    //     $tanggalCetak = Carbon::now();
    //     $aktivitasGym = BookingGym::where(
    //         "tanggal_sesi_gym",
    //         "<",
    //         $tanggalCetak
    //     )
    //         ->where("status_kehadiran", 1)
    //         ->where("is_canceled", 0)
    //         ->whereMonth("tanggal_sesi_gym", $bulan) //* lewat parmas
    //         ->get()
    //         ->groupBy(function ($item) {
    //             //*group by tanggal
    //             $carbonDate = Carbon::createFromFormat(
    //                 "Y-m-d",
    //                 $item->tanggal_sesi_gym
    //             );
    //             return $carbonDate->format("Y-m-d");
    //         });
    //     //* Data yang diambil data booking gym yang udah lewat(tanggal sesi gymnya status kehadiran 1) dan tidak dibatalin

    //     //* Count
    //     $responseData = [];

    //     foreach ($aktivitasGym as $tanggal => $grup) {
    //         $count = $grup->count();
    //         $responseData[] = [
    //             "tanggal" => $tanggal,
    //             "count" => $count,
    //         ];
    //     }

    //     return response([
    //         "data" => $responseData,
    //         "tanggal_cetak" => $tanggalCetak,
    //     ]);
    // }

    public function kinerjaInstrukturBulanan(Request $request)
    {
        $bulan = Carbon::now()->month;
        if ($request->has("month") && !empty($request->month)) {
            $bulan = $request->month;
        }

        $tanggalCetak = Carbon::now()->translatedFormat("d F Y");
        $kinerjaInstruktur = DB::select(
            '
            SELECT i.NAMA_INSTRUKTUR,
            SUM(CASE WHEN pi.ID_PRESENSI_INSTRUKTUR IS NOT NULL THEN 1 ELSE 0 END) AS JUMLAH_HADIR,
            SUM(CASE WHEN iz.ID_IZIN IS NOT NULL THEN 1 ELSE 0 END) AS JUMLAH_IZIN,        
            IFNULL(pi.WAKTU_TERLAMBAT, 0) AS WAKTU_TERLAMBAT
            FROM instruktur AS i
            LEFT JOIN presensi_instruktur AS pi ON i.ID_INSTRUKTUR = pi.ID_INSTRUKTUR AND MONTH(pi.created_at) = ?
            LEFT JOIN izin AS iz ON i.ID_INSTRUKTUR = iz.ID_INSTRUKTUR AND MONTH(iz.created_at) = ?
            GROUP BY i.NAMA_INSTRUKTUR, pi.WAKTU_TERLAMBAT
            ORDER BY pi.WAKTU_TERLAMBAT ASC
            ',
            [$bulan, $bulan]
        );
        return view("Laporan/LaporanInstruktur")->with([
            "user" => Auth::guard("pegawai")->user(),
            "data" => $kinerjaInstruktur,
            "tanggal_cetak" => $tanggalCetak,
        ]);
    }

    public function indexPendapatan()
    {
        return view("Laporan/LaporanPendapatan")->with([
            "user" => Auth::guard("pegawai")->user(),
            "data_depo_class" => [],
            "data_activation" => [],
            "data_total_income" => [],
        ]);
    }

    public function pendapatanProcess(Request $request)
    {
        Session::start();
        if ($request->accepts("text/html")) {
            $validate = $request->validate([
                "year_filter" => ["required"],
            ]);

            for ($x = 0; $x < 12; $x++) {
                $report_income_deposit[] = DB::select(
                    'SELECT MONTHNAME(t.TANGGAL_TRANSAKSI_KELAS) as bulan, SUM(t.JUMLAH_BAYAR) AS total_income_deposit FROM 
                    (SELECT jumlah_bayar, tanggal_transaksi_kelas FROM transaksi_deposit_kelas 
                    UNION ALL 
                    SELECT total_deposit_uang, tanggal_transaksi_uang FROM transaksi_deposit_uang) t WHERE YEAR(t.TANGGAL_TRANSAKSI_KELAS) = ' .
                        $request->year_filter .
                        " AND MONTH(t.TANGGAL_TRANSAKSI_KELAS) =" .
                        $x .
                        " +1 GROUP BY bulan"
                );

                $report_income_activaton[] = DB::select(
                    'SELECT MONTHNAME(TANGGAL_AKTIVASI) as bulan, SUM(BIAYA_AKTIVASI) as total_income_activation 
                    FROM transaksi_aktivasi 
                    WHERE YEAR(TANGGAL_AKTIVASI) = ' .
                        $request->year_filter .
                        " AND MONTH(TANGGAL_AKTIVASI) =" .
                        $x .
                        " + 1 GROUP BY bulan"
                );

                $report_total[] = DB::select(
                    'SELECT MONTHNAME(t.TANGGAL_TRANSAKSI_KELAS) as bulan, SUM(t.JUMLAH_BAYAR) AS total_income FROM 
                    (SELECT jumlah_bayar, tanggal_transaksi_kelas FROM transaksi_deposit_kelas 
                    UNION ALL 
                    SELECT total_deposit_uang, tanggal_transaksi_uang FROM transaksi_deposit_uang
                    UNION ALL
                    SELECT biaya_aktivasi, tanggal_aktivasi FROM transaksi_aktivasi ) t WHERE YEAR(t.TANGGAL_TRANSAKSI_KELAS) = ' .
                        $request->year_filter .
                        " AND MONTH(t.TANGGAL_TRANSAKSI_KELAS) =" .
                        $x .
                        " +1 GROUP BY bulan"
                );
            }

            $collection = collect([$report_total]);

            $collapsed = $collection->collapse();
            $collapsed2 = $collapsed->collapse();

            $temp_keys = [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ];
            $temp_value = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            $keys = [];
            $value = [];

            for ($i = 0; $i < 12; $i++) {
                if ($collapsed[$i]) {
                    $keys[] = $collapsed[$i][0]->bulan;
                    $value[] = $collapsed[$i][0]->total_income;
                } else {
                    $keys[] = $temp_keys[$i];
                    $value[] = $temp_value[$i];
                }
            }

            $request->session()->save();

            return redirect()
                ->intended("dashboard/laporanPendapatan")
                ->with([
                    "success" =>
                        "Berhasil Mendapatkan Laporan Pendapatan Pada " .
                        $request->year_filter,
                    "user" => Auth::guard("pegawai")->user(),
                    "data_depo_class" => $report_income_deposit,
                    "data_activation" => $report_income_activaton,
                    "data_total_income" => $report_total,
                    "year" => $request->year_filter,
                    "report_keys" => $keys,
                    "report_value" => $value,
                ]);
        } else {
            // for($x = 0; $x < 12 ; $x++){

            //     $report_income_deposit[] = DB::select(
            //         'SELECT MONTHNAME(t.TANGGAL_DEPOSIT_KELAS) as bulan, SUM(t.jumlah_pembayaran) AS total_income_deposit FROM
            //         (SELECT jumlah_pembayaran, tanggal_transaksi_kelas FROM transaksi_deposit_kelas
            //         UNION ALL
            //         SELECT jumlah_deposit, tanggal_transaksi_uang FROM transaksi_deposit_uang) t WHERE YEAR(t.TANGGAL_DEPOSIT_KELAS) = 2023 AND MONTH(t.TANGGAL_DEPOSIT_KELAS) ='.$x.' + 1 GROUP BY bulan');

            //     $report_income_activaton[] = DB::select(
            //         'SELECT MONTHNAME(TANGGAL_TRANSAKSI_AKTIVASI) as bulan, SUM(BIAYA_AKTIVASI) as total_income_activation
            //         FROM transaksi_aktivasi
            //         WHERE YEAR(TANGGAL_TRANSAKSI_AKTIVASI) = 2023 AND MONTH(TANGGAL_TRANSAKSI_AKTIVASI) ='.$x.' + 1 GROUP BY bulan');

            //     $report_total[] = DB::select(
            //         'SELECT MONTHNAME(t.TANGGAL_DEPOSIT_KELAS) as bulan, SUM(t.jumlah_pembayaran) AS total_income FROM
            //         (SELECT jumlah_pembayaran, tanggal_transaksi_kelas FROM transaksi_deposit_kelas
            //         UNION ALL
            //         SELECT jumlah_deposit, tanggal_deposit_uang FROM transaksi_deposit_uang
            //         UNION ALL
            //         SELECT biaya_aktivasi, tanggal_aktivasi FROM transaksi_aktivasi ) t WHERE YEAR(t.TANGGAL_DEPOSIT_KELAS) = 2023 AND MONTH(t.TANGGAL_DEPOSIT_KELAS) ='.$x.' +1 GROUP BY bulan'
            //     );
            // }

            // $report_total2 = DB::select(
            //     'SELECT MONTHNAME(t.TANGGAL_DEPOSIT_KELAS) as bulan, SUM(t.jumlah_pembayaran) AS total_income FROM
            //     (SELECT jumlah_pembayaran, tanggal_transaksi_kelas FROM transaksi_deposit_kelas
            //     UNION ALL
            //     SELECT jumlah_deposit, tanggal_deposit_uang FROM transaksi_deposit_uang
            //     UNION ALL
            //     SELECT biaya_aktivasi, tanggal_aktivasi FROM transaksi_aktivasi ) t WHERE YEAR(t.TANGGAL_DEPOSIT_KELAS) = 2023 GROUP BY bulan'
            // );

            // $fruits = collect($report_total)->only('bulan');
            // $collapse = $fruits->collapse();

            // $collection = collect([]);

            // $collection = collect([
            //     $report_total
            // ]);

            // $collapsed = $collection->collapse();
            // $collapsed2 = $collapsed->collapse();

            // foreach ($collapsed2 as $item) {
            //         if($item){
            //             $temp[] = $item->bulan;
            //         }
            // }
            // $temp_keys =['January','February','March','April','May','June','July','August','September','October','November','December'];
            // $temp_value = [0,0,0,0,0,0,0,0,0,0,0,0];
            // $keys = [];
            // $value = [];

            // for($i = 0; $i < 12; $i++){
            //     if($collapsed[$i]){
            //         $keys[] = $collapsed[$i][0]->bulan;
            //         $value[] = $collapsed[$i][0]->total_income;
            //     }else{
            //         $keys[] = $temp_keys[$i];
            //         $value[] = $temp_value[$i];
            //     }
            // }

            // return response([
            //     'data_depo_class' => $report_income_deposit,
            //     'data_activation' => $report_income_activaton,
            //     'data_total_income' => $report_total,
            //     'report_keys'=> $keys,
            //     'report_values' => $value
            // ]);
        }
    }

    public function indexGym(Request $request)
    {
        if ($request->accepts("text/html")) {
            return view("Laporan/LaporanAktivitasGym")->with([
                "user" => Auth::guard("pegawai")->user(),
                "data_gym_activity" => null,
            ]);
        }
    }

    public function gymProcess(Request $request)
    {
        if ($request->accepts("text/html")) {
            $validate = $request->validate([
                "year_filter" => ["required"],
                "month_filter" => ["required"],
            ]);

            $data_gym_activity = DB::select(
                'SELECT TANGGAL_BOOKING_GYM as tanggal, COUNT(KODE_BOOKING_GYM) as jumlah_member  FROM `booking_presensi_gym` 
            WHERE YEAR(TANGGAL_BOOKING_GYM) = ' .
                    $request->year_filter .
                    '
            AND STATUS_PRESENSI_GYM = "Hadir"
            AND MONTH(TANGGAL_BOOKING_GYM) = ' .
                    $request->month_filter .
                    '
            GROUP BY TANGGAL_BOOKING_GYM'
            );

            // Session::flash("print", "yes");
            // Session::start();

            return redirect()
                ->intended("dashboard/laporanAktivitasGym")
                ->with([
                    "success" =>
                        "Berhasil Mendapatkan Laporan Gym Pada " .
                        Carbon::now()
                            ->month($request->month_filter)
                            ->translatedformat("F") .
                        " " .
                        $request->year_filter,
                    "user" => Auth::guard("pegawai")->user(),
                    "data_gym_activity" => $data_gym_activity,
                    "year" => $request->year_filter,
                    "month" => $request->month_filter,
                    "print" => "yes",
                ]);
        }
    }

    public function indexKelas(Request $request)
    {
        if ($request->accepts("text/html")) {
            return view("Laporan/LaporanAktivitasKelas")->with([
                "user" => Auth::guard("pegawai")->user(),
                "data_class_activity" => null,
            ]);
        }
    }

    public function kelasProcess(Request $request)
    {
        if ($request->accepts("text/html")) {
            $validate = $request->validate([
                "year_filter" => ["required"],
                "month_filter" => ["required"],
            ]);

            $data_class_activity = DB::select(
                'SELECT k.NAMA_KELAS AS kelas, i.nama_instruktur AS instruktur, 
            SUM(CASE WHEN bk.KODE_BOOKING_KELAS IS NOT NULL THEN 1 ELSE 0 END) AS jumlah_peserta_kelas, 
            SUM(CASE WHEN jh.STATUS_JADWAL_HARIAN = "Libur" THEN 1 ELSE 0 END) AS jumlah_libur 
            FROM kelas as k 
            LEFT JOIN jadwal_umum as ju on ju.ID_KELAS = k.ID_KELAS 
            LEFT JOIN jadwal_harian as jh on ju.ID_JADWAL_UMUM = jh.ID_JADWAL_UMUM 
            LEFT JOIN instruktur AS i ON jh.id_instruktur = i.id_instruktur 
            LEFT JOIN booking_presensi_kelas as bk on jh.TANGGAL_HARIAN = bk.TANGGAL_HARIAN 
            WHERE MONTH(jh.tanggal_harian) = ' .
                    $request->month_filter .
                    " AND YEAR(jh.TANGGAL_HARIAN) = " .
                    $request->year_filter .
                    " GROUP BY k.NAMA_KELAS, i.NAMA_INSTRUKTUR;"
            );

            return redirect()
                ->intended("dashboard/laporanAktivitasKelas")
                ->with([
                    "success" =>
                        "Berhasil Mendapatkan Laporan Aktivias Kelas Pada " .
                        Carbon::now()
                            ->month($request->month_filter)
                            ->translatedformat("F") .
                        " " .
                        $request->year_filter,
                    "user" => Auth::guard("pegawai")->user(),
                    "data_class_activity" => $data_class_activity,
                    "year" => $request->year_filter,
                    "month" => $request->month_filter,
                    "print" => "yes",
                ]);
        } else {
            // $data_class_activity = DB::select('SELECT k.NAMA_KELAS AS kelas, i.nama_instruktur AS instruktur, COUNT(bk.KODE_BOOKING_KELAS) AS jumlah_peserta_kelas,
            // COUNT(CASE WHEN jh.KETERANGAN_JADWAL_HARIAN = "Libur" THEN 1 ELSE NULL END) AS jumlah_libur
            // FROM booking_kelas AS bk
            // JOIN jadwal_harian AS jh ON bk.TANGGAL_JADWAL_HARIAN = jh.TANGGAL_JADWAL_HARIAN
            // JOIN jadwal_umum AS ju ON jh.id_jadwal_umum = ju.id_jadwal_umum
            // JOIN instruktur AS i ON jh.id_instruktur = i.id_instruktur
            // JOIN kelas AS k ON ju.id_kelas = k.id_kelas
            // WHERE MONTH(jh.tanggal_jadwal_harian) = 6 AND YEAR(jh.TANGGAL_JADWAL_HARIAN) = 2023
            // GROUP BY k.NAMA_KELAS, i.nama_instruktur');

            // return response([
            //     'data_class_activity' => $data_class_activity
            // ]);
        }
    }

    public function indexInstruktur(Request $request)
    {
        if ($request->accepts("text/html")) {
            return view("Laporan/LaporanInstruktur")->with([
                "user" => Auth::guard("pegawai")->user(),
                "data_instructor" => null,
            ]);
        }
    }

    public function instrukturProcess(Request $request)
    {
        if ($request->accepts("text/html")) {
            $validate = $request->validate([
                "year_filter" => ["required"],
                "month_filter" => ["required"],
            ]);

            $data_instructor = DB::select(
                'SELECT i.nama_instruktur, SUM(CASE WHEN pi.ID_PRESENSI_INSTRUKTUR IS NOT NULL THEN 1 ELSE 0 END) AS jumlah_hadir, 
                SUM(CASE WHEN iz.ID_IZIN IS NOT NULL THEN 1 ELSE 0 END) AS jumlah_izin, 
            SUM(CASE WHEN pi.WAKTU_TERLAMBAT iS NOT NULL THEN pi.WAKTU_TERLAMBAT ELSE 0 END) AS akumulasi_terlambat 
            FROM instruktur AS i 
            LEFT JOIN presensi_instruktur AS pi ON i.id_instruktur = pi.id_instruktur 
            AND MONTH(pi.created_at) = ' .
                    $request->month_filter .
                    " AND YEAR(pi.created_at) = " .
                    $request->year_filter .
                    '
            LEFT JOIN izin AS iz ON i.id_instruktur = iz.id_instruktur 
            AND MONTH(iz.created_at) = ' .
                    $request->month_filter .
                    "  AND YEAR(iz.created_at) = " .
                    $request->year_filter .
                    '
            GROUP BY i.NAMA_INSTRUKTUR, i.jumlah_terlambat
            ORDER BY SUM(CASE WHEN pi.WAKTU_TERLAMBAT iS NOT NULL THEN pi.WAKTU_TERLAMBAT ELSE 0 END) '
            );

            return redirect()
                ->intended("dashboard/laporanInstruktur")
                ->with([
                    "success" =>
                        "Berhasil Mendapatkan Laporan Instruktur Pada " .
                        Carbon::now()
                            ->month($request->month_filter)
                            ->translatedformat("F") .
                        " " .
                        $request->year_filter,
                    "user" => Auth::guard("pegawai")->user(),
                    "data_instructor" => $data_instructor,
                    "year" => $request->year_filter,
                    "month" => $request->month_filter,
                    "print" => "yes",
                ]);
        }
    }
}
