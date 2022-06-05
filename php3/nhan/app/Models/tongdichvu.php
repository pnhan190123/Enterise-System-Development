<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tongdichvu extends Model
{
    use HasFactory;
    protected $table='tongdichvu';
    protected $primaryKey='id_tong';
    protected $fillable=[
        'id_tong ',
        'role_tongdv',
        'id_giaodich',
        'id_nap',
        'idUser',
        'sotien',
        'loai',
        'thoigianmua',
        'thoigianhethan',
        'thang',
    ];
}
