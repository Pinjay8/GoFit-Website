<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = "ID_MEMBER";
    protected $guard = "member";
    protected $table = "member";
    protected $keyType = "string";

    protected $fillable = [
        "NAMA_MEMBER",
        "NO_TELPON_MEMBER",
        "USIA_MEMBER",
        "ALAMAT_MEMBER",
        "JENIS_KELAMIN_MEMBER",
        "TANGGAL_LAHIR_MEMBER",
        "SISA_DEPOSIT_UANG",
        "SISA_DEPOSIT_KELAS",
        "EMAIL_MEMBER",
        "password",
        "MASA_AKTIVASI",
        "MASA_EXPIRED",
        "TGL_NONAKTIF",
        "TGL_RESET_KELAS",
    ];

    // protected $hidden = ["password", "remember_token"];

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
