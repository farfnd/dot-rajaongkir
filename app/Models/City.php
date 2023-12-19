<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $primaryKey = 'city_id';

    protected $fillable = [
        "province_id",
        "province",
        "type",
        "city_name",
        "postal_code",
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
