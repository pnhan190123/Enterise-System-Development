<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ykien extends Model
{
    use HasFactory;

    protected $table='ykien';
    protected $primaryKey='idYKien';
    protected $fillable=[
        'idYKien',
        'idTin',
        'Ngay',
        'NoiDung',
        'Email',
        'HoTen',
        'AnHien',
    ];
}
