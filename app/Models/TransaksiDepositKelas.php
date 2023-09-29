<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TransaksiDepositKelas extends Model
{
    use HasFactory;

    protected $primaryKey = "ID_TRANSAKSI_KELAS";
    protected $table = "transaksi_deposit_kelas";
    protected $keyType = "string";

    protected $fillable = [
        "ID_MEMBER",
        "ID_PROMO",
        "BONUS_DEPOSIT_KELAS",
        "TANGGAL_TRANSAKSI_KELAS",
        "ID_KELAS",
        "ID_PEGAWAI",
        "JUMLAH_BAYAR",
        "JUMLAH_DEPOSIT",
        "TOTAL_DEPOSIT_KELAS",
        "MASA_BERLAKU_KELAS",
        "KEMBALIAN",
    ];

    public function member()
    {
        return $this->belongsTo("App\Models\Member", "ID_MEMBER");
    }

    public function memberdepo()
    {
        return $this->belongsTo("App\Models\MemberDepo", "ID_MEMBER_DEPO");
    }

    public function kelas()
    {
        return $this->belongsTo("App\Models\Kelas", "ID_KELAS");
    }

    public function pegawai()
    {
        return $this->belongsTo("App\Models\Pegawai", "ID_PEGAWAI");
    }

    public function promo()
    {
        return $this->belongsTo("App\Models\Promo", "ID_PROMO");
    }

    public function getCreatedAtAttribute()
    {
        if (!is_null($this->attributes["created_at"])) {
            return Carbon::parse($this->attributes["created_at"])->format(
                "Y-m-d H:i:s"
            );
        }
    }

    public function getUpdatedAtAttribute()
    {
        if (!is_null($this->attributes["update_at"])) {
            return Carbon::parse($this->attributes["update_at"])->format(
                "Y-m-d H:i:s"
            );
        }
    }
}
