<?php

namespace App\Models;

use App\Models\Parking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $primaryKey = 'vehicle_id';
    protected $fillable = [
        'vehicle_id', 'no_polisi', 'jenis_kendaraan'
    ];

    public function parking()
    {
        return $this->hasOne(Parking::class);
    }
}
