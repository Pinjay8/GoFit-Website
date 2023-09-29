<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Promo extends Model
{
    use HasFactory;

    protected $primaryKey = "ID_PROMO";
    protected $guard = "promo";
    protected $table = "promo";

    protected $fillable = [
        "NAMA_PROMO",
        "TANGGAL_MULAI_PROMO",
        "TANGGAL_BATAS_PROMO",
        "JENIS_PROMO",
        "MINIMAL_BELI",
        "SYARAT_PROMO",
        "BONUS",
    ];
}
