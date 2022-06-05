<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tin extends Model
{
    use HasFactory;

    protected $table='tin';
    protected $primaryKey='idTin';
    protected $fillable=[
        'idTin',
        'TieuDe',
        'TomTat',
        'urlHinh',
        'Ngay',
        'idUser',
        'Content',
        'idLT',
        'idTL',
        'SoLanXem',
        'NoiBat',
        'tags',
        'AnHien',
        'lang',
        'role_tin'
    ];
}
