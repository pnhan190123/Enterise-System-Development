<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class giaodich extends Model
{
    use HasFactory;
    protected $table='giaodich';
    // protected $primaryKey='idUser';
    protected $primaryKey='id_giaodich';
    protected $fillable=[
        'id_giaodich',
        'idUser',
        'role_giaodich',
        'id_DichVu',
        'thoigianmua',
        'thoigianhethan',
        'loai',

       
    ];
}
