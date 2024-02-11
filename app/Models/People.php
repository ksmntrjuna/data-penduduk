<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $fillable = ['name', 'nik', 'gender', 'birthdate', 'address', 'province_id', 'district_id'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}

