<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class JadwalUmum extends Model
{
    use HasFactory;

    protected $primaryKey = "ID_JADWAL_UMUM";
    protected $guard = "jadwal_umum";
    protected $table = "jadwal_umum";

    protected $fillable = [
        "HARI_JADWAL_UMUM",
        "TANGGAL_JADWAL_UMUM",
        "ID_KELAS",
        "ID_INSTRUKTUR",
        "WAKTU_JADWAL_UMUM",
    ];

    public function instruktur()
    {
        return $this->belongsTo("App\Models\Instruktur", "ID_INSTRUKTUR");
    }

    public function kelas()
    {
        return $this->belongsTo("App\Models\Kelas", "ID_KELAS");
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
