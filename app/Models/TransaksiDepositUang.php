<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TransaksiDepositUang extends Model
{
    use HasFactory;

    protected $primaryKey = "ID_TRANSAKSI_UANG";
    protected $table = "transaksi_deposit_uang";
    protected $keyType = "string";

    protected $fillable = [
        "ID_MEMBER",
        "ID_PROMO",
        "JUMLAH_DEPOSIT_UANG",
        "TANGGAL_TRANSAKSI_UANG",
        "TOTAL_DEPOSIT_UANG",
        "ID_PEGAWAI",
        "BONUS_DEPOSIT_UANG",
        "SISA_DEPOSIT_UANG_TRANSAKSI",
        "KEMBALIAN",
    ];

    public function member()
    {
        return $this->belongsTo("App\Models\Member", "ID_MEMBER");
    }

    public function promo()
    {
        return $this->belongsTo("App\Models\Promo", "ID_PROMO");
    }

    public function pegawai()
    {
        return $this->belongsTo("App\Models\Pegawai", "ID_PEGAWAI");
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
        if (!is_null($this->attributes["updated_at"])) {
            return Carbon::parse($this->attributes["updated_at"])->format(
                "Y-m-d H:i:s"
            );
        }
    }
}
