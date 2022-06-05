<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quangcaobaibao extends Model
{
    use HasFactory;
    protected $table='quangcaobaibao';
    protected $primaryKey='id';
    protected $fillable=[
        'id',
        'id_editor',
        'role_quangcao',
        'idUser',
        'yeucau',
        'id_loaibaibao',
        'urlHinh',
        'loai_quangcao',
        'noidung',
        'ngayyeucau',
        'ngayduocduyet',
    ];
}
