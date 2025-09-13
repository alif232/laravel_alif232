<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumahSakit extends Model
{
    use HasFactory;

    protected $table = 'rumah_sakits';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama_rumah_sakit',
        'alamat',
        'email',
        'telepon',
    ];
}
