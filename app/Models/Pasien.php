<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasiens';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nama_pasien',
        'alamat',
        'no_telpon',
        'rumah_sakit_id',
    ];

    public function rumah_sakit()
    {
        return $this->belongsTo(RumahSakit::class, 'rumah_sakit_id');
    }
}
