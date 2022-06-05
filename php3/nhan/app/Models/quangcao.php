<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quangcao extends Model
{
    use HasFactory;
    protected $table='quangcao';
    protected $primaryKey='id_quangcao';
    protected $fillable=[
        'id_quangcao',
        'loai_quangcao',
        'urlHinh',
        'yeucau',
        'id_editor',
        'id_loaiquangcao',
        'AnHien',
        'role_quangcao',
        'idUser',
        'thoigianyeucau',
        'thoigianhethan',
    ];
}
