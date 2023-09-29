<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TransaksiAktivasi extends Model
{
    use HasFactory;

    protected $primaryKey = "ID_TRANSAKSI_AKTIVASI";
    protected $table = "transaksi_aktivasi";
    protected $keyType = "string";

    protected $fillable = [
        "ID_MEMBER",
        "TANGGAL_EXPIRED_TRANSAKSI_AKTIVASI",
        "TANGGAL_AKTIVASI",
        "ID_PEGAWAI",
        "BIAYA_AKTIVASI",
        "STATUS",
        "KEMBALIAN",
    ];

    public function member()
    {
        return $this->belongsTo("App\Models\Member", "ID_MEMBER");
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
        if (!is_null($this->attributes["update_at"])) {
            return Carbon::parse($this->attributes["update_at"])->format(
                "Y-m-d H:i:s"
            );
        }
    }
}
