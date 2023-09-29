<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Izin extends Model
{
    use HasFactory;

    protected $primaryKey = "ID_IZIN";
    protected $table = "izin";

    protected $fillable = [
        "ID_INSTRUKTUR",
        "INSTRUKTUR_PENGGANTI",
        "TANGGAL_IZIN",
        "TANGGAL_PENGAJUAN",
        "KETERANGAN_IZIN",
        "TANGGAL_KONFIRMASI",
        "STATUS_KONFIRMASI",
    ];

    public function instruktur()
    {
        return $this->belongsTo("App\Models\Instruktur", "ID_INSTRUKTUR");
    }

    public function jadwalHarian()
    {
        return $this->belongsTo("App\Models\JadwalHarian", "TANGGAL_HARIAN");
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
