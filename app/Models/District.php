<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'province_id'];

    // Relasi antara Kabupaten dan Provinsi
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
