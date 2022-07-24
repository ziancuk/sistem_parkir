<?php

namespace App\Models;

use App\Models\Vehicle;
use App\Models\Fault;
use App\Models\Blok;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    protected $primaryKey = 'kode_parkir';
    public $incrementing = false;
    protected $fillable = [
        'kode_parkir', 'user_id', 'vehicle_id', 'fault_id', 'waktu_masuk', 'waktu_keluar', 'biaya', 'petugas_out', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
    public function fault()
    {
        return $this->belongsTo(Fault::class, 'fault_id');
    }
}
