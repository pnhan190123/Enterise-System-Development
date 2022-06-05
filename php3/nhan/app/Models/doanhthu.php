<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doanhthu extends Model
{
    use HasFactory;
    protected $table='doanhthu';
    protected $primaryKey='id_doanhthu';
    protected $fillable=[
        'id_doanhthu',
        'role_doanhthu',
        'sotien',
        'id_giaodich',
        'id_nap',
        'created_at',
        'created_at',
    ];
}
