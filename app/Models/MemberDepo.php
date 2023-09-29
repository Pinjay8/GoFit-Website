<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MemberDepo extends Model
{
    use HasFactory;

    protected $primaryKey = "ID_MEMBER_DEPO";
    protected $table = "member_deposit";

    protected $fillable = [
        "ID_KELAS",
        "ID_MEMBER",
        "MASA_BERLAKU",
        "SISA_DEPO",
        "EXPIRED_KELAS",
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
