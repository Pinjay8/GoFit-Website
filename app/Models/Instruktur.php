<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;

class Instruktur extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = "ID_INSTRUKTUR";
    protected $guard = "instruktur";
    protected $table = "instruktur";

    protected $fillable = [
        "NAMA_INSTRUKTUR",
        "JENIS_KELAMIN_INSTRUKTUR",
        "NO_TELPON_INSTRUKTUR",
        "USIA_INSTRUKTUR",
        "EMAIL_INSTRUKTUR",
        "password",
        "JUMLAH_TERLAMBAT",
        "TGL_EXPIRED",
    ];

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
