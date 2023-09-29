<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class JadwalHarian extends Model
{
    use HasFactory;

    protected $primaryKey = "TANGGAL_HARIAN";
    protected $guard = "jadwal_harian";
    protected $table = "jadwal_harian";
    protected $keyType = "datetime";

    protected $fillable = [
        "ID_JADWAL_UMUM",
        "ID_INSTRUKTUR",
        "TANGGAL_HARIAN",
        "STATUS_JADWAL_HARIAN",
        "TGL_EXPIRED",
    ];

    public function instruktur()
    {
        return $this->belongsTo("App\Models\Instruktur", "ID_INSTRUKTUR");
    }

    public function jadwalUmum()
    {
        return $this->belongsTo("App\Models\JadwalUmum", "ID_JADWAL_UMUM");
    }

    public function kelas()
    {
        return $this->belongsTo("App\Models\Kelas", "ID_KELAS");
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format("Y-m-d H:i:s");
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
