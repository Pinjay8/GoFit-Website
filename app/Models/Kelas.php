<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;

class Kelas extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = "ID_KELAS";
    protected $guard = "kelas";
    protected $table = "kelas";
    protected $keyType = "string";

    protected $fillable = ["NAMA_KELAS", "TARIF_KELAS", "KAPASITAS"];

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
